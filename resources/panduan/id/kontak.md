Menu **Contact** mengelola semua informasi kontak BPI yang tampil di halaman **Contact** website: alamat kantor, peta Google Maps, media sosial, email, dan nomor telepon/WhatsApp. Sebagian informasi ini (alamat, email, dan media sosial) juga dipakai di **footer** (bagian paling bawah) semua halaman.

Buka menu: [Contact](cms:admin.kontak.index)

> **Catatan:** Biasanya cukup ada **satu** data kontak. Untuk mengubah informasi kontak, **edit data yang sudah ada** (ikon ✏️). Jangan membuat data kontak baru.

## Mengubah informasi kontak

Klik ✏️ pada data kontak. Formulirnya terbagi menjadi lima bagian.

### 1. Location & Map (Google Maps)

1. Buka **Google Maps**, lalu cari lokasi kantor BPI.
2. Klik tombol **Bagikan / Share**, lalu **Salin link** (alamatnya biasanya diawali `https://maps.app.goo.gl/...`).
3. Tempelkan link tersebut di kolom **Google Maps Link**.

Sistem akan otomatis membaca titik koordinat dari link tersebut dan menghubungkan tombol "Buka di Google Maps" di website. Kolom **Manual Coordinate Settings (Latitude / Longitude)** hanya perlu diisi jika peta menunjuk ke lokasi yang salah.

Kotak **Status: Active** harus tetap tercentang agar data kontak tampil di website.

### 2. Social Media

Daftar akun media sosial resmi BPI. Klik **+ Add Social Media Account** untuk menambah baris, lalu isi:

- **Platform**: Instagram, YouTube, Facebook, LinkedIn, TikTok, Twitter / X, atau Website.
- **Username / Handle**: misalnya `@bpi.indonesia`.
- **Profile URL**: boleh dikosongkan karena akan dibuat otomatis dari username. Isi manual hanya jika alamat profilnya berbeda dari pola biasa.

Klik ikon 🗑️ untuk menghapus baris.

### 3. Email Address

Klik **+ Add Email** untuk menambah alamat email resmi, misalnya `info@bpi.or.id`. Kolom **Mailto URL** boleh dikosongkan.

> **Penting:** **Email pertama** dalam daftar dipakai sebagai email utama, misalnya untuk tombol "Hubungi Sekretariat" di halaman Projects dan Stakeholders. Letakkan email yang paling aktif di urutan teratas.

### 4. Phone Number & WhatsApp

Klik **+ Add Number**, lalu isi:

- **Contact Number**: nomor telepon, misalnya `0878 3992 0990` atau `+62 878 3992 0990`.
- **Type**: **WhatsApp**, **Office Phone** (telepon kantor), **Hotline**, atau **Fax**.
- **Click-to-Action URL**: boleh dikosongkan. Untuk WhatsApp, sistem otomatis membuat tautan `https://wa.me/62…` (angka 0 di depan nomor diubah menjadi 62).

### 5. Office & Contact Page Information (dua bahasa)

Isi di setiap tab bahasa:

| Kelompok | Kolom | Contoh |
|---|---|---|
| 📌 Judul utama | **Section Title** (wajib) | *Informasi Kontak* |
| 🗂️ Deskripsi kartu | **Social Media / Email / Phone-WhatsApp Card Description** | Kalimat singkat di setiap kartu kontak |
| 📮 Bagian merah (peta & formulir) | **Badge Kecil Section**, **Red Section Title**, **Red Section Description** | *Hubungi Kami*, ajakan mengunjungi kantor |
| 🏢 Kantor | **Office / Secretariat Name**, **Full Office Address**, **Office Hours** | *Sekretariat BPI*, alamat lengkap, *Senin – Jumat: 09.00 – 17.00 WIB* |

Setelah selesai, klik **Update Contact**.

## Teks lain di halaman Contact

Label kartu, tulisan tombol ("Hubungi via WhatsApp", "Salin Alamat Email"), serta label dan pesan pada **formulir kontak** ("Nama Lengkap", "Kirim Pesan", pesan berhasil terkirim) diubah lewat tombol **Page Texts**. Lihat bab [Teks Halaman](bab:teks-halaman).

Pesan yang dikirim pengunjung melalui formulir kontak dibaca di menu **Contact Messages**. Tombol **View Incoming Messages** di halaman ini juga membuka menu tersebut. Lihat bab [Contact Messages](bab:pesan-kontak).
