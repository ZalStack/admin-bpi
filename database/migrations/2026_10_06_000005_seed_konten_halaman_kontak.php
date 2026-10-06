<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Teks halaman Kontak (label kartu, tombol, teks form kirim pesan) yang bisa
 * diedit dari CMS. Isi awal = teks yang saat ini tampil. Header, deskripsi
 * kartu, alamat, dan data kontak tetap di modul Contact (tabel kontak).
 */
return new class extends Migration
{
    private const HALAMAN = 'kontak';

    public function up(): void
    {
        $social = 'Social Media Card';
        $email = 'Email Card';
        $whatsapp = 'WhatsApp Card';
        $map = 'Office Map';
        $form = 'Contact Form';

        $items = [
            ['sosial.badge', $social, 'Badge', 'text', 'MEDIA SOSIAL', 'SOCIAL MEDIA'],
            ['sosial.judul', $social, 'Title', 'text', 'Ikuti Kabar Terbaru Kami', 'Follow Our Latest Updates'],

            ['email.badge', $email, 'Badge', 'text', 'EMAIL RESMI', 'OFFICIAL EMAIL'],
            ['email.tombol', $email, 'Copy Button', 'text', 'Salin Alamat Email', 'Copy Email Address'],

            ['whatsapp.badge', $whatsapp, 'Badge', 'text', 'WHATSAPP CENTER', 'WHATSAPP CENTER'],
            ['whatsapp.tombol', $whatsapp, 'Chat Button', 'text', 'Hubungi via WhatsApp', 'Contact via WhatsApp'],

            ['peta.label', $map, 'Map Badge', 'text', 'Lokasi Kantor', 'Office Location'],
            ['peta.tombol', $map, 'Google Maps Button', 'text', 'Buka di Google Maps', 'Open in Google Maps'],

            ['form.label_nama', $form, 'Label: Full Name', 'text', 'Nama Lengkap', 'Full Name'],
            ['form.label_subjek', $form, 'Label: Subject', 'text', 'Subjek / Topik Pesan', 'Subject / Inquiry Topic'],
            ['form.label_pesan', $form, 'Label: Message', 'text', 'Isi Pesan', 'Message Content'],
            ['form.tombol', $form, 'Submit Button', 'text', 'Kirim Pesan', 'Send Message'],
            ['form.sukses_judul', $form, 'Success Message: Title', 'text', 'Pesan Berhasil Terkirim!', 'Message Sent Successfully!'],
            ['form.sukses_pesan', $form, 'Success Message: Text', 'textarea',
                'Terima kasih telah menghubungi Badan Perfilman Indonesia. Tim sekretariat kami akan segera menindaklanjuti pesan Anda.',
                'Thank you for reaching out to Badan Perfilman Indonesia. Our secretariat team will review and follow up on your message.'],
            ['form.catatan', $form, 'Note Below the Form', 'text',
                'Semua pesan ditangani secara resmi oleh Sekretariat BPI.',
                'All inquiries are handled confidentially by BPI Secretariat.'],
        ];

        // Terjemahan hanya untuk bahasa yang terdaftar (FK ke tabel bahasa).
        $bahasa = DB::table('bahasa')->whereIn('kode', ['id', 'en'])->pluck('kode')->all();
        $now = now();

        foreach ($items as $urutan => [$kunci, $grup, $label, $tipe, $nilaiId, $nilaiEn]) {
            $id = DB::table('konten_halaman')->insertGetId([
                'halaman' => self::HALAMAN,
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

    public function down(): void
    {
        // Terjemahan ikut terhapus lewat FK cascade.
        DB::table('konten_halaman')->where('halaman', self::HALAMAN)->delete();
    }
};
