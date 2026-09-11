<?php

namespace App\Console\Commands;

use App\Mail\PesanKontakMasukMail;
use App\Models\KontakForm;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestContactEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test-contact {email? : Alamat email tujuan pengujian}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim simulasi email notifikasi pesan kontak masuk untuk pengujian';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $targetEmail = $this->argument('email')
            ?: config('mail.contact_recipient')
            ?: config('mail.from.address');

        if (! $targetEmail || ! filter_var($targetEmail, FILTER_VALIDATE_EMAIL)) {
            $targetEmail = $this->ask('Masukkan alamat email tujuan penerima notifikasi (contoh: email.anda@gmail.com)');
        }

        if (! filter_var($targetEmail, FILTER_VALIDATE_EMAIL)) {
            $this->error('Alamat email tidak valid.');
            return self::FAILURE;
        }

        $mailer = config('mail.default');
        $this->info("=== INFORMASI KONFIGURASI MAIL ===");
        $this->line("Mailer Driver   : <comment>{$mailer}</comment>");
        $this->line("Host            : <comment>" . config("mail.mailers.{$mailer}.host", '-') . "</comment>");
        $this->line("Port            : <comment>" . config("mail.mailers.{$mailer}.port", '-') . "</comment>");
        $this->line("From Address    : <comment>" . config('mail.from.address') . "</comment>");
        $this->line("Target Penerima : <info>{$targetEmail}</info>");
        $this->newLine();

        $this->info("Menyiapkan pesan uji coba...");

        // Buat dummy data tanpa harus menyimpan ke database
        $dummy = new KontakForm([
            'nama' => 'Budi Santoso (Pengunjung Website)',
            'email' => 'pengunjung.contoh@gmail.com',
            'subjek' => 'Pertanyaan Kemitraan & Informasi Layanan (Uji Coba)',
            'pesan' => "Halo Admin BPI,\n\nIni adalah pesan simulasi pengujian formulir kontak website.\n\nJika email ini sampai ke inbox Anda, silakan coba tekan tombol 'Reply / Balas' di aplikasi email Anda. Anda akan melihat bahwa tujuan balasan otomatis terisi ke: pengunjung.contoh@gmail.com.\n\nSalam hangat,\nBudi Santoso",
            'status' => 'unread',
        ]);
        $dummy->created_at = now();
        $dummy->id = 999;

        $this->comment("Sedang mengirim email notifikasi ke {$targetEmail}...");

        try {
            Mail::to($targetEmail)->send(new PesanKontakMasukMail($dummy));

            $this->newLine();
            if ($mailer === 'log') {
                $this->warn(" Perhatian: MAIL_MAILER disetel ke 'log'. Email tidak dikirim ke internet, melainkan dicatat pada file storage/logs/laravel.log.");
            } else {
                $this->info(" SUKSES! Email notifikasi berhasil dikirim ke {$targetEmail}.");
                $this->line("Silakan periksa kotak masuk (Inbox) atau folder Spam pada email Anda.");
                $this->line("Tips: Coba klik 'Reply / Balas' pada email yang masuk untuk melihat apakah alamat tujuan otomatis terisi ke email pengirim tamu.");
            }

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->newLine();
            $this->error(" GAGAL mengirim email: " . $e->getMessage());
            $this->newLine();
            $this->line("<comment>Tips pemeriksaan:</comment>");
            $this->line("1. Jika menggunakan Gmail SMTP, pastikan menggunakan App Password (bukan password login biasa).");
            $this->line("2. Pastikan port (587 TLS atau 465 SSL) tidak diblokir oleh provider internet/antivirus.");
            $this->line("3. Cek kembali MAIL_USERNAME dan MAIL_PASSWORD pada file .env.");

            return self::FAILURE;
        }
    }
}
