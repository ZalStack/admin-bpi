<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail:test-contact {email? : Alamat email tujuan pengujian}', function ($email = null) {
    return $this->call(\App\Console\Commands\TestContactEmailCommand::class, [
        'email' => $email,
    ]);
})->purpose('Kirim simulasi email notifikasi pesan kontak masuk untuk pengujian');

