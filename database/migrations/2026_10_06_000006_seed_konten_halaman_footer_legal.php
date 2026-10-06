<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Teks Footer serta isi halaman Kebijakan Privasi & Syarat Ketentuan yang bisa
 * diedit dari CMS (menu Footer & Legal). Isi awal = teks yang saat ini tampil.
 * Isi halaman legal memakai rich text editor (tipe 'richtext').
 */
return new class extends Migration
{
    private const HALAMAN = ['footer', 'privasi', 'syarat'];

    public function up(): void
    {
        $this->seed('footer', [
            ['tagline', 'Brand Column', 'Tagline', 'textarea', 'Menyelaraskan, memajukan, dan menduniakan ekosistem perfilman Indonesia.', 'Harmonizing, advancing, and globalizing Indonesia\'s film ecosystem.'],
            ['tentang.judul', 'Column: About BPI', 'Column Title', 'text', 'Tentang BPI', 'About BPI'],
            ['tentang.profil', 'Column: About BPI', 'Link: Profile', 'text', 'Profil', 'Profile'],
            ['tentang.visi', 'Column: About BPI', 'Link: Vision', 'text', 'Visi', 'Vision'],
            ['tentang.misi', 'Column: About BPI', 'Link: Mission', 'text', 'Misi', 'Mission'],
            ['tentang.struktur', 'Column: About BPI', 'Link: Organizational Structure', 'text', 'Struktur Organisasi', 'Organizational Structure'],
            ['informasi.judul', 'Column: Information', 'Column Title', 'text', 'Informasi', 'Information'],
            ['informasi.program', 'Column: Information', 'Link: Programs & Roadmap', 'text', 'Program & Peta Jalan', 'Programs & Roadmap'],
            ['informasi.proyek', 'Column: Information', 'Link: Collaborative Projects', 'text', 'Proyek Kolaborasi', 'Collaborative Projects'],
            ['informasi.berita', 'Column: Information', 'Link: News', 'text', 'Berita', 'News'],
            ['informasi.opini', 'Column: Information', 'Link: Opinion', 'text', 'Opini', 'Opinion'],
            ['jaringan.judul', 'Column: Network & Contact', 'Column Title', 'text', 'Jaringan & Kontak', 'Network & Contact'],
            ['jaringan.stakeholder', 'Column: Network & Contact', 'Link: Stakeholders', 'text', 'Pemangku Kepentingan', 'Stakeholders'],
            ['jaringan.kontak', 'Column: Network & Contact', 'Link: Contact Us', 'text', 'Hubungi Kami', 'Contact Us'],
            ['hak_cipta', 'Bottom Bar', 'Copyright Text (the year is added automatically)', 'text', 'Badan Perfilman Indonesia. Hak Cipta Dilindungi Undang-Undang.', 'Badan Perfilman Indonesia (Indonesian Film Agency). All Rights Reserved.'],
            ['legal.privasi', 'Bottom Bar', 'Link: Privacy Policy', 'text', 'Kebijakan Privasi', 'Privacy Policy'],
            ['legal.syarat', 'Bottom Bar', 'Link: Terms & Conditions', 'text', 'Syarat & Ketentuan', 'Terms & Conditions'],
        ]);

        $this->seed('privasi', [
            ['judul', 'Page Header', 'Badge', 'text', 'Kebijakan Privasi', 'Privacy Policy'],
            ['subjudul', 'Page Header', 'Headline', 'textarea', 'Komitmen kami dalam melindungi dan mengelola data pribadi pengguna situs Badan Perfilman Indonesia.', 'Our commitment to protecting and managing the personal data of visitors to the Indonesian Film Agency\'s website.'],
            ['tanggal', 'Page Header', 'Last Updated Date', 'text', '7 September 2026', '7 September 2026'],
            ['isi', 'Content', 'Page Content', 'richtext', '<h2>1. Pendahuluan</h2><p>Badan Perfilman Indonesia (“BPI”, “kami”) menghormati privasi setiap pengunjung situs resmi kami. Kebijakan Privasi ini menjelaskan jenis informasi yang kami kumpulkan, bagaimana informasi tersebut digunakan, dan langkah-langkah yang kami ambil untuk melindunginya saat Anda menggunakan situs ini.</p><h2>2. Informasi yang Kami Kumpulkan</h2><p>Kami dapat mengumpulkan informasi berikut saat Anda mengakses situs ini:</p><ul><li>Data yang Anda berikan secara langsung, seperti nama, alamat email, dan pesan saat mengisi formulir kontak atau pendaftaran asosiasi.</li><li>Data teknis non-pribadi, seperti jenis peramban, perangkat, dan halaman yang dikunjungi, untuk keperluan analitik dan peningkatan layanan.</li></ul><h2>3. Bagaimana Kami Menggunakan Informasi</h2><p>Informasi yang kami kumpulkan digunakan untuk:</p><ul><li>Merespons pertanyaan, permintaan kerja sama, atau pesan yang Anda kirimkan.</li><li>Mengelola dan memverifikasi pendaftaran asosiasi/stakeholder.</li><li>Meningkatkan kualitas konten dan fungsionalitas situs.</li><li>Mengirimkan informasi resmi terkait program dan kegiatan BPI, apabila Anda berlangganan.</li></ul><h2>4. Perlindungan Data</h2><p>Kami menerapkan langkah-langkah teknis dan organisasi yang wajar untuk melindungi data pribadi Anda dari akses, perubahan, pengungkapan, atau perusakan yang tidak sah. Namun, tidak ada metode transmisi data melalui internet yang sepenuhnya aman, sehingga kami tidak dapat menjamin keamanan mutlak.</p><h2>5. Cookie dan Teknologi Pelacakan</h2><p>Situs ini dapat menggunakan cookie untuk mengingat preferensi bahasa dan meningkatkan pengalaman menjelajah Anda. Anda dapat mengatur peramban untuk menolak cookie, meskipun hal ini dapat memengaruhi sebagian fungsi situs.</p><h2>6. Berbagi Informasi dengan Pihak Ketiga</h2><p>Kami tidak menjual atau menyewakan data pribadi Anda kepada pihak ketiga. Informasi hanya dapat dibagikan kepada mitra resmi BPI atau instansi berwenang apabila diperlukan untuk memenuhi kewajiban hukum atau atas persetujuan Anda.</p><h2>7. Hak Pengguna</h2><p>Anda berhak untuk mengakses, memperbarui, atau meminta penghapusan data pribadi yang telah Anda berikan kepada kami dengan menghubungi kami melalui kanal resmi yang tercantum pada halaman Kontak.</p><h2>8. Perubahan Kebijakan Privasi</h2><p>Kebijakan Privasi ini dapat diperbarui dari waktu ke waktu mengikuti perkembangan layanan dan ketentuan hukum yang berlaku. Perubahan akan diinformasikan melalui pembaruan tanggal pada halaman ini.</p><h2>9. Hubungi Kami</h2><p>Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini, silakan hubungi kami melalui email <a href="mailto:sekretariat@bpi.or.id">sekretariat@bpi.or.id</a> atau melalui halaman Kontak kami.</p>', '<h2>1. Introduction</h2><p>The Indonesian Film Agency (“BPI”, “we”) respects the privacy of every visitor to our official website. This Privacy Policy explains the types of information we collect, how that information is used, and the steps we take to protect it while you use this site.</p><h2>2. Information We Collect</h2><p>We may collect the following information when you access this site:</p><ul><li>Information you provide directly, such as your name, email address, and message when filling out the contact form or association registration.</li><li>Non-personal technical data, such as browser type, device, and pages visited, for analytics and service improvement purposes.</li></ul><h2>3. How We Use Information</h2><p>The information we collect is used to:</p><ul><li>Respond to inquiries, partnership requests, or messages you send.</li><li>Manage and verify association/stakeholder registrations.</li><li>Improve the quality of the site&#x27;s content and functionality.</li><li>Send official information about BPI programs and activities, if you subscribe.</li></ul><h2>4. Data Protection</h2><p>We implement reasonable technical and organizational measures to protect your personal data from unauthorized access, alteration, disclosure, or destruction. However, no method of data transmission over the internet is completely secure, so we cannot guarantee absolute security.</p><h2>5. Cookies and Tracking Technologies</h2><p>This site may use cookies to remember your language preference and improve your browsing experience. You may configure your browser to reject cookies, although this may affect some site functionality.</p><h2>6. Sharing Information with Third Parties</h2><p>We do not sell or rent your personal data to third parties. Information may only be shared with BPI&#x27;s official partners or authorized institutions when required to fulfill legal obligations or with your consent.</p><h2>7. User Rights</h2><p>You have the right to access, update, or request deletion of the personal data you have provided to us by contacting us through the official channels listed on our Contact page.</p><h2>8. Changes to This Privacy Policy</h2><p>This Privacy Policy may be updated from time to time in line with service developments and applicable legal requirements. Changes will be indicated by an updated date on this page.</p><h2>9. Contact Us</h2><p>If you have any questions about this Privacy Policy, please contact us via email at <a href="mailto:sekretariat@bpi.or.id">sekretariat@bpi.or.id</a> or through our Contact page.</p>'],
        ]);

        $this->seed('syarat', [
            ['judul', 'Page Header', 'Badge', 'text', 'Syarat & Ketentuan', 'Terms & Conditions'],
            ['subjudul', 'Page Header', 'Headline', 'textarea', 'Ketentuan penggunaan yang berlaku bagi setiap pengunjung situs resmi Badan Perfilman Indonesia.', 'Terms of use that apply to every visitor of the Indonesian Film Agency\'s official website.'],
            ['tanggal', 'Page Header', 'Last Updated Date', 'text', '7 September 2026', '7 September 2026'],
            ['isi', 'Content', 'Page Content', 'richtext', '<h2>1. Penerimaan Ketentuan</h2><p>Dengan mengakses dan menggunakan situs resmi Badan Perfilman Indonesia (“BPI”, “kami”), Anda dianggap telah membaca, memahami, dan menyetujui untuk terikat pada Syarat &amp; Ketentuan ini beserta Kebijakan Privasi kami. Apabila Anda tidak menyetujui ketentuan ini, mohon untuk tidak melanjutkan penggunaan situs.</p><h2>2. Penggunaan Layanan</h2><p>Anda setuju untuk menggunakan situs ini secara bertanggung jawab, dengan tidak:</p><ul><li>Menyalahgunakan situs untuk tujuan yang melanggar hukum atau merugikan pihak lain.</li><li>Mencoba mengakses sistem, data, atau area situs secara tidak sah.</li><li>Menyebarkan konten yang bersifat menyesatkan, mencemarkan nama baik, atau melanggar hak pihak ketiga melalui formulir yang tersedia di situs ini.</li></ul><h2>3. Hak Kekayaan Intelektual</h2><p>Seluruh konten pada situs ini, termasuk namun tidak terbatas pada teks, logo, gambar, grafis, dan tata letak, merupakan milik BPI atau digunakan dengan izin, dan dilindungi oleh peraturan perundang-undangan hak cipta yang berlaku. Dilarang menyalin, memperbanyak, atau mendistribusikan konten tanpa izin tertulis dari BPI, kecuali untuk kepentingan pribadi dan non-komersial.</p><h2>4. Konten Pengguna</h2><p>Informasi yang Anda kirimkan melalui formulir kontak, pendaftaran asosiasi, atau kanal komunikasi lain di situs ini harus akurat dan menjadi tanggung jawab Anda sepenuhnya. BPI berhak menolak atau menghapus informasi yang dianggap tidak sesuai, tidak akurat, atau melanggar ketentuan ini.</p><h2>5. Tautan ke Pihak Ketiga</h2><p>Situs ini dapat memuat tautan ke situs pihak ketiga (misalnya mitra atau media sosial). BPI tidak bertanggung jawab atas konten, kebijakan privasi, atau praktik dari situs pihak ketiga tersebut. Akses terhadap tautan tersebut sepenuhnya menjadi risiko Anda sendiri.</p><h2>6. Batasan Tanggung Jawab</h2><p>BPI berupaya menjaga akurasi dan ketersediaan informasi pada situs ini, namun tidak menjamin bahwa situs akan selalu bebas dari kesalahan atau gangguan teknis. BPI tidak bertanggung jawab atas kerugian langsung maupun tidak langsung yang timbul akibat penggunaan atau ketidaktersediaan situs ini.</p><h2>7. Perubahan Ketentuan</h2><p>BPI berhak mengubah atau memperbarui Syarat &amp; Ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya. Perubahan akan berlaku sejak dipublikasikan pada halaman ini, sehingga kami menganjurkan Anda untuk meninjaunya secara berkala.</p><h2>8. Hukum yang Berlaku</h2><p>Syarat &amp; Ketentuan ini diatur dan ditafsirkan sesuai dengan hukum yang berlaku di Republik Indonesia. Setiap perselisihan yang timbul akan diselesaikan secara musyawarah, atau apabila diperlukan, melalui mekanisme hukum yang berlaku.</p><h2>9. Hubungi Kami</h2><p>Jika Anda memiliki pertanyaan mengenai Syarat &amp; Ketentuan ini, silakan hubungi kami melalui email <a href="mailto:sekretariat@bpi.or.id">sekretariat@bpi.or.id</a> atau melalui halaman Kontak kami.</p>', '<h2>1. Acceptance of Terms</h2><p>By accessing and using the official website of the Indonesian Film Agency (“BPI”, “we”), you are deemed to have read, understood, and agreed to be bound by these Terms &amp; Conditions together with our Privacy Policy. If you do not agree to these terms, please do not continue using the site.</p><h2>2. Use of Service</h2><p>You agree to use this site responsibly, and not to:</p><ul><li>Misuse the site for unlawful purposes or to harm other parties.</li><li>Attempt to gain unauthorized access to the site&#x27;s systems, data, or areas.</li><li>Distribute content that is misleading, defamatory, or infringes third-party rights through forms available on this site.</li></ul><h2>3. Intellectual Property Rights</h2><p>All content on this site, including but not limited to text, logos, images, graphics, and layout, is owned by BPI or used with permission, and is protected under applicable copyright laws. Copying, reproducing, or distributing content without BPI&#x27;s written permission is prohibited, except for personal and non-commercial use.</p><h2>4. User-Submitted Content</h2><p>Information you submit through the contact form, association registration, or other communication channels on this site must be accurate and is entirely your responsibility. BPI reserves the right to reject or remove information deemed inappropriate, inaccurate, or in violation of these terms.</p><h2>5. Links to Third Parties</h2><p>This site may contain links to third-party websites (e.g., partners or social media). BPI is not responsible for the content, privacy policies, or practices of such third-party sites. Accessing those links is entirely at your own risk.</p><h2>6. Limitation of Liability</h2><p>BPI strives to maintain the accuracy and availability of information on this site, but does not guarantee that the site will always be free of errors or technical disruptions. BPI is not liable for any direct or indirect losses arising from the use or unavailability of this site.</p><h2>7. Changes to These Terms</h2><p>BPI reserves the right to change or update these Terms &amp; Conditions at any time without prior notice. Changes take effect once published on this page, so we encourage you to review it periodically.</p><h2>8. Governing Law</h2><p>These Terms &amp; Conditions are governed by and construed in accordance with the laws applicable in the Republic of Indonesia. Any disputes arising will be resolved amicably, or if necessary, through applicable legal mechanisms.</p><h2>9. Contact Us</h2><p>If you have any questions about these Terms &amp; Conditions, please contact us via email at <a href="mailto:sekretariat@bpi.or.id">sekretariat@bpi.or.id</a> or through our Contact page.</p>'],
        ]);
    }

    public function down(): void
    {
        // Terjemahan ikut terhapus lewat FK cascade.
        DB::table('konten_halaman')->whereIn('halaman', self::HALAMAN)->delete();
    }

    private function seed(string $halaman, array $items): void
    {
        // Terjemahan hanya untuk bahasa yang terdaftar (FK ke tabel bahasa).
        $bahasa = DB::table('bahasa')->whereIn('kode', ['id', 'en'])->pluck('kode')->all();
        $now = now();

        foreach ($items as $urutan => [$kunci, $grup, $label, $tipe, $nilaiId, $nilaiEn]) {
            $id = DB::table('konten_halaman')->insertGetId([
                'halaman' => $halaman,
                'kunci' => $kunci,
                'grup' => $grup,
                'label' => $label,
                'tipe' => $tipe,
                'urutan' => $urutan + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach (['id' => $nilaiId, 'en' => $nilaiEn] as $kode => $nilai) {
                if (in_array($kode, $bahasa, true)) {
                    DB::table('konten_halaman_translations')->insert([
                        'konten_halaman_id' => $id,
                        'bahasa' => $kode,
                        'nilai' => $nilai,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
};
