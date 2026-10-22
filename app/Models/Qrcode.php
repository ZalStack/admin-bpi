<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Qrcode extends Model
{
    protected $table = 'qrcode';

    public const LOGO_MODES = ['none', 'bpi', 'upload'];

    protected $fillable = [
        'judul',
        'shortlink_id',
        'url_tujuan',
        'warna_depan',
        'warna_latar',
        'logo_mode',
        'logo',
        'caption',
        'created_by',
    ];

    public function shortlink(): BelongsTo
    {
        return $this->belongsTo(Shortlink::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Isi yang di-encode ke QR: short URL bila terkait shortlink
     * (tujuan bisa diganti & pindaian terhitung), selain itu URL langsung.
     */
    public function getKontenAttribute(): string
    {
        return $this->shortlink ? $this->shortlink->short_url : (string) $this->url_tujuan;
    }

    /**
     * URL logo tengah. asset() mengikuti host request, sehingga gambar
     * selalu same-origin dan canvas bisa diekspor ke PNG tanpa ter-taint.
     */
    public function getLogoUrlAttribute(): ?string
    {
        return match ($this->logo_mode) {
            'bpi' => asset('images/logo-bpi-qr.png'),
            'upload' => $this->logo ? asset('storage/qrcode/'.$this->logo) : null,
            default => null,
        };
    }
}
