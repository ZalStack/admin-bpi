<!DOCTYPE html>
<html lang="{{ $bahasa }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $t['judul_index'] }} - Admin Panel BPI</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bpi.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white font-poppins text-gray-800">
    <div class="mx-auto max-w-4xl px-6 py-10">
        <div class="mb-6 flex justify-end print:hidden">
            <button type="button" onclick="window.print()" class="btn-primary">{{ $t['cetak_pdf'] }}</button>
        </div>

        {{-- Sampul --}}
        <header class="guide-cover">
            <img src="{{ asset('images/logo-bpi.png') }}" alt="Logo BPI" class="h-20 w-auto">
            <h1 class="mt-8 text-4xl font-bold text-[#520A18]">{{ $t['judul_index'] }}</h1>
            <p class="mt-2 text-lg text-gray-600">{{ $t['sampul_subjudul'] }}</p>
            <p class="mt-10 text-sm text-gray-500">
                {{ $t['dicetak_oleh'] }} {{ auth()->user()->name }} &middot; {{ now()->locale($bahasa)->isoFormat('D MMMM Y') }}
            </p>
        </header>

        {{-- Daftar isi --}}
        <section class="guide-page">
            <h2 class="mb-4 text-2xl font-bold text-[#520A18]">{{ $t['daftar_isi'] }}</h2>
            <ol class="list-decimal space-y-1 pl-6">
                @foreach($babs as $bab)
                    <li><a href="#bab-{{ $bab['slug'] }}" class="hover:underline">{{ $bab['judul'] }}</a></li>
                @endforeach
            </ol>
        </section>

        @foreach($babs as $bab)
            <section id="bab-{{ $bab['slug'] }}" class="guide-page">
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#5876B0]">{{ $t['bab'] }} {{ $loop->iteration }} &middot; {{ $bab['grup'] }}</p>
                <h1 class="mt-1 text-3xl font-bold text-[#520A18]">{{ $bab['judul'] }}</h1>
                <p class="mt-1 text-gray-500">{{ $bab['ringkasan'] }}</p>
                <div class="guide-prose mt-6">
                    {!! $bab['konten']['html'] !!}
                </div>
            </section>
        @endforeach
    </div>
</body>
</html>
