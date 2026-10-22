// Render QR Code di browser CMS (pratinjau, unduh PNG & SVG).
// Diadaptasi dari fsldk-web qrcode-preview.ts: level koreksi H bila ada logo,
// logo ~22% di tengah di atas bantalan latar, caption satu baris di bawah kode.
// Library `qrcode` di-import dinamis supaya hanya dimuat di halaman QR.

export const QR_DEFAULT_FG = '#16336D';
export const QR_DEFAULT_BG = '#FFFFFF';

export const QR_FG_SWATCHES = [
    { label: 'Navy (BPI)', value: '#16336D' },
    { label: 'Maroon (BPI)', value: '#68001C' },
    { label: 'Gold (BPI)', value: '#97763A' },
    { label: 'Black', value: '#111827' },
];

export const QR_BG_SWATCHES = [
    { label: 'White', value: '#FFFFFF' },
    { label: 'Cream', value: '#F6F5F2' },
    { label: 'Beige (BPI)', value: '#F1ECDD' },
];

const PLACEHOLDER_CONTENT = 'https://example.com';
const QUIET_ZONE = 2; // modul
const HEX = /^#[0-9A-Fa-f]{6}$/;

let qrLib;
const loadQrLib = () => (qrLib ??= import('qrcode').then((m) => m.default ?? m));

const imageCache = new Map();

function loadImage(src) {
    if (!src) return Promise.resolve(null);
    if (imageCache.has(src)) return imageCache.get(src);

    const promise = new Promise((resolve) => {
        const img = new Image();
        img.onload = () => resolve(img);
        img.onerror = () => {
            imageCache.delete(src);
            resolve(null);
        };
        img.src = src;
    });
    // data: URL (pratinjau unggahan) tidak di-cache agar memori tidak menumpuk.
    if (!src.startsWith('data:')) imageCache.set(src, promise);
    return promise;
}

function normalize(o) {
    return {
        content: (o.content || '').trim() || PLACEHOLDER_CONTENT,
        fg: HEX.test(o.fg || '') ? o.fg : QR_DEFAULT_FG,
        bg: HEX.test(o.bg || '') ? o.bg : QR_DEFAULT_BG,
        caption: (o.caption || '').trim(),
        logoSrc: o.logoSrc || null,
    };
}

const captionHeight = (size, caption) => (caption ? Math.round(size * 0.12) : 0);
const captionFont = (size) => `600 ${Math.round(size * 0.05)}px Poppins, system-ui, sans-serif`;
// Caption sedikit naik ke quiet zone bawah supaya tidak terlalu jauh dari kode.
const captionY = (size, capH) => size + capH / 2 - size * 0.015;

function logoRect(size, img) {
    const box = size * 0.22;
    const scale = Math.min(box / img.naturalWidth, box / img.naturalHeight);
    const w = img.naturalWidth * scale;
    const h = img.naturalHeight * scale;
    return { x: (size - w) / 2, y: (size - h) / 2, w, h, pad: box * 0.12 };
}

function roundRectPath(ctx, x, y, w, h, r) {
    const rr = Math.min(r, w / 2, h / 2);
    ctx.beginPath();
    ctx.moveTo(x + rr, y);
    ctx.arcTo(x + w, y, x + w, y + h, rr);
    ctx.arcTo(x + w, y + h, x, y + h, rr);
    ctx.arcTo(x, y + h, x, y, rr);
    ctx.arcTo(x, y, x + w, y, rr);
    ctx.closePath();
}

function fitText(ctx, text, maxWidth) {
    if (ctx.measureText(text).width <= maxWidth) return text;
    let trimmed = text;
    while (trimmed.length > 1 && ctx.measureText(trimmed + '…').width > maxWidth) {
        trimmed = trimmed.slice(0, -1);
    }
    return trimmed + '…';
}

async function ensureFont(size) {
    try {
        await document.fonts?.load(captionFont(size));
    } catch {
        // fallback ke font sistem
    }
}

/**
 * Render QR ke <canvas> target. Dirender ke kanvas offscreen dulu lalu disalin,
 * dengan token supaya render lama yang selesai belakangan tidak menimpa yang baru.
 */
export async function renderQr(canvas, options, size = 320) {
    if (!canvas) return;
    const token = Symbol('render');
    canvas.__qrToken = token;

    const o = normalize(options);
    const [QRCode, logo] = await Promise.all([loadQrLib(), loadImage(o.logoSrc)]);
    const capH = captionHeight(size, o.caption);

    const qrCanvas = document.createElement('canvas');
    try {
        await QRCode.toCanvas(qrCanvas, o.content, {
            errorCorrectionLevel: logo ? 'H' : 'M',
            margin: QUIET_ZONE,
            width: size,
            color: { dark: o.fg, light: o.bg },
        });
    } catch (error) {
        console.error('QR render failed:', error);
        return;
    }

    const out = document.createElement('canvas');
    out.width = size;
    out.height = size + capH;
    const ctx = out.getContext('2d');
    ctx.fillStyle = o.bg;
    ctx.fillRect(0, 0, out.width, out.height);
    ctx.drawImage(qrCanvas, 0, 0, size, size);

    if (logo) {
        const r = logoRect(size, logo);
        roundRectPath(ctx, r.x - r.pad, r.y - r.pad, r.w + 2 * r.pad, r.h + 2 * r.pad, r.pad);
        ctx.fillStyle = o.bg;
        ctx.fill();
        ctx.drawImage(logo, r.x, r.y, r.w, r.h);
    }

    if (o.caption) {
        await ensureFont(size);
        ctx.font = captionFont(size);
        ctx.fillStyle = o.fg;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText(fitText(ctx, o.caption, size * 0.9), size / 2, captionY(size, capH));
    }

    if (canvas.__qrToken !== token) return;
    canvas.width = out.width;
    canvas.height = out.height;
    canvas.getContext('2d').drawImage(out, 0, 0);
}

function imageToDataUrl(img) {
    const max = 512;
    const scale = Math.min(1, max / Math.max(img.naturalWidth, img.naturalHeight));
    const c = document.createElement('canvas');
    c.width = Math.round(img.naturalWidth * scale);
    c.height = Math.round(img.naturalHeight * scale);
    c.getContext('2d').drawImage(img, 0, 0, c.width, c.height);
    return c.toDataURL('image/png');
}

const escapeXml = (s) =>
    s.replace(/[<>&"']/g, (ch) => ({ '<': '&lt;', '>': '&gt;', '&': '&amp;', '"': '&quot;', "'": '&apos;' })[ch]);

/**
 * SVG vektor dengan tata letak yang sama seperti renderQr (logo ditanam
 * sebagai data URI PNG, jadi file SVG berdiri sendiri).
 */
export async function buildSvg(options, size = 1024) {
    const o = normalize(options);
    const [QRCode, logo] = await Promise.all([loadQrLib(), loadImage(o.logoSrc)]);
    const capH = captionHeight(size, o.caption);

    const raw = await QRCode.toString(o.content, {
        type: 'svg',
        errorCorrectionLevel: logo ? 'H' : 'M',
        margin: QUIET_ZONE,
        color: { dark: o.fg, light: o.bg },
    });
    const modules = Number(/viewBox="0 0 (\d+) \d+"/.exec(raw)?.[1] || 1);
    const body = raw.replace(/^[\s\S]*?<svg[^>]*>/, '').replace(/<\/svg>\s*$/, '');

    const parts = [
        `<rect width="${size}" height="${size + capH}" fill="${o.bg}"/>`,
        `<g transform="scale(${size / modules})" shape-rendering="crispEdges">${body}</g>`,
    ];

    if (logo) {
        const r = logoRect(size, logo);
        parts.push(
            `<rect x="${r.x - r.pad}" y="${r.y - r.pad}" width="${r.w + 2 * r.pad}" height="${r.h + 2 * r.pad}" rx="${r.pad}" fill="${o.bg}"/>`,
            `<image href="${imageToDataUrl(logo)}" x="${r.x}" y="${r.y}" width="${r.w}" height="${r.h}"/>`,
        );
    }

    if (o.caption) {
        await ensureFont(size);
        const ctx = document.createElement('canvas').getContext('2d');
        ctx.font = captionFont(size);
        const text = fitText(ctx, o.caption, size * 0.9);
        parts.push(
            `<text x="${size / 2}" y="${captionY(size, capH)}" fill="${o.fg}" font-family="Poppins, Arial, sans-serif" font-weight="600" font-size="${Math.round(size * 0.05)}" text-anchor="middle" dominant-baseline="middle">${escapeXml(text)}</text>`,
        );
    }

    return `<?xml version="1.0" encoding="UTF-8"?>\n<svg xmlns="http://www.w3.org/2000/svg" width="${size}" height="${size + capH}" viewBox="0 0 ${size} ${size + capH}">${parts.join('')}</svg>`;
}

function saveBlob(blob, filename) {
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    a.remove();
    setTimeout(() => URL.revokeObjectURL(url), 1000);
}

export async function downloadPng(options, name, size = 1024) {
    const canvas = document.createElement('canvas');
    await renderQr(canvas, options, size);
    canvas.toBlob((blob) => blob && saveBlob(blob, `${slugify(name)}.png`), 'image/png');
}

export async function downloadSvg(options, name, size = 1024) {
    const svg = await buildSvg(options, size);
    saveBlob(new Blob([svg], { type: 'image/svg+xml' }), `${slugify(name)}.svg`);
}

export function slugify(value) {
    const slug = String(value || '')
        .toLowerCase()
        .normalize('NFKD')
        .replace(/[^\w\s-]/g, '')
        .trim()
        .replace(/[\s_-]+/g, '-')
        .slice(0, 60);
    return slug ? `qr-${slug}` : 'qr-code';
}

function luminance(hex) {
    const [r, g, b] = [1, 3, 5]
        .map((i) => parseInt(hex.slice(i, i + 2), 16) / 255)
        .map((v) => (v <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4));
    return 0.2126 * r + 0.7152 * g + 0.0722 * b;
}

/**
 * Peringatan keterbacaan: kontras rendah atau warna terbalik (kode lebih
 * terang dari latar) sering gagal dipindai.
 */
export function readabilityWarning(fg, bg) {
    if (!HEX.test(fg || '') || !HEX.test(bg || '')) return 'Use a valid 6-digit hex color.';
    const lf = luminance(fg);
    const lb = luminance(bg);
    if (lf > lb) return 'The QR color is lighter than the background. Many scanners cannot read inverted QR codes.';
    if ((lb + 0.05) / (lf + 0.05) < 4) return 'Low contrast between QR and background colors. The code may be hard to scan.';
    return null;
}

function copyText(text) {
    if (navigator.clipboard && window.isSecureContext) {
        return navigator.clipboard.writeText(text);
    }
    // Fallback untuk http non-localhost
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed';
    ta.style.opacity = '0';
    document.body.appendChild(ta);
    ta.select();
    document.execCommand('copy');
    ta.remove();
    return Promise.resolve();
}

window.copyText = copyText;

document.addEventListener('alpine:init', () => {
    const Alpine = window.Alpine;

    // Form create/edit QR Code dengan pratinjau langsung.
    Alpine.data('qrDesigner', (cfg = {}) => ({
        shortlinks: cfg.shortlinks || [],
        judul: cfg.judul || '',
        sumber: cfg.sumber || 'shortlink',
        shortlinkId: cfg.shortlinkId ? String(cfg.shortlinkId) : '',
        urlTujuan: cfg.urlTujuan || '',
        fg: cfg.fg || QR_DEFAULT_FG,
        bg: cfg.bg || QR_DEFAULT_BG,
        logoMode: cfg.logoMode || 'bpi',
        uploadedLogo: cfg.logoUrl || null,
        bpiLogoUrl: cfg.bpiLogoUrl || null,
        caption: cfg.caption || '',
        fgSwatches: QR_FG_SWATCHES,
        bgSwatches: QR_BG_SWATCHES,

        get selectedShortlink() {
            return this.shortlinks.find((s) => String(s.id) === this.shortlinkId) || null;
        },
        get content() {
            return this.sumber === 'shortlink' ? this.selectedShortlink?.short_url || '' : this.urlTujuan.trim();
        },
        get logoSrc() {
            if (this.logoMode === 'bpi') return this.bpiLogoUrl;
            if (this.logoMode === 'upload') return this.uploadedLogo;
            return null;
        },
        get options() {
            return { content: this.content, fg: this.fg, bg: this.bg, caption: this.caption, logoSrc: this.logoSrc };
        },
        get warning() {
            return readabilityWarning(this.fg, this.bg);
        },
        get fileName() {
            return this.judul || this.selectedShortlink?.kode || 'code';
        },

        render(canvas) {
            renderQr(canvas, this.options, 320);
        },
        onLogoChange(event) {
            const file = event.target.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = () => (this.uploadedLogo = reader.result);
            reader.readAsDataURL(file);
        },
        downloadPng() {
            downloadPng(this.options, this.fileName);
        },
        downloadSvg() {
            downloadSvg(this.options, this.fileName);
        },
    }));

    // Thumbnail + tombol unduh pada daftar QR Code.
    Alpine.data('qrThumb', (options = {}, name = '') => ({
        init() {
            renderQr(this.$refs.canvas, options, 160);
        },
        downloadPng() {
            downloadPng(options, name);
        },
        downloadSvg() {
            downloadSvg(options, name);
        },
    }));

    // Modal "QR cepat" di daftar Shortlink: gaya default + logo BPI.
    Alpine.data('qrQuick', (cfg = {}) => ({
        open: false,
        kode: '',
        shortUrl: '',
        customizeUrl: '',
        get options() {
            return { content: this.shortUrl, fg: QR_DEFAULT_FG, bg: QR_DEFAULT_BG, logoSrc: cfg.bpiLogoUrl };
        },
        show({ kode, shortUrl, customizeUrl }) {
            this.kode = kode;
            this.shortUrl = shortUrl;
            this.customizeUrl = customizeUrl || '';
            this.open = true;
            this.$nextTick(() => renderQr(this.$refs.canvas, this.options, 280));
        },
        downloadPng() {
            downloadPng(this.options, this.kode);
        },
        downloadSvg() {
            downloadSvg(this.options, this.kode);
        },
    }));
});
