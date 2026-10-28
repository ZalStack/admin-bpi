Selamat datang! Bab ini menjelaskan apa itu CMS, cara masuk dan keluar, serta cara membaca tampilan CMS. Bacalah bab ini dan bab [Konsep Dasar](bab:dasar) sebelum mulai mengubah isi website.

## Apa itu CMS?

**CMS** (*Content Management System*) adalah "ruang kendali" website Badan Perfilman Indonesia (BPI). Semua yang tampil di website, seperti teks, gambar, berita, logo mitra, dan struktur organisasi, **diambil dari CMS ini**.

Bayangkan website sebagai **etalase toko**, dan CMS sebagai **ruang staf di belakangnya**. Pengunjung hanya melihat etalase. Anda mengatur isi etalase dari ruang staf. Jadi ketika Anda mengubah sesuatu di CMS dan menyimpannya, website ikut berubah tanpa perlu bantuan programmer.

> **Catatan:** Setelah menyimpan, buka halaman website yang bersangkutan lalu muat ulang (tekan **F5**, atau **Ctrl + F5** jika perubahan belum terlihat). Jika setelah beberapa menit perubahan tetap belum muncul, hubungi tim teknis.

## Cara masuk (login)

1. Buka alamat CMS di browser (Google Chrome, Microsoft Edge, atau Mozilla Firefox). Alamat CMS diberikan oleh Super Admin atau tim teknis.
2. Isi **Email Address** (alamat email) dan **Password** akun Anda.
3. Centang **Remember Me** (ingat saya) *hanya* jika Anda memakai komputer pribadi. Jangan dicentang di komputer bersama atau komputer umum.
4. Klik tombol **Log In to Dashboard**.

Jika muncul tulisan **"Incorrect email or password. Please try again."** (email atau password salah), periksa kembali ejaan email dan password. Perhatikan huruf besar dan kecil, serta pastikan tombol **Caps Lock** tidak menyala. Klik ikon mata di kolom password untuk melihat apa yang Anda ketik.

> **Penting:** Demi keamanan, CMS hanya mengizinkan **5 kali percobaan login per menit**. Jika terlalu sering salah, tunggu sekitar 1 menit sebelum mencoba lagi.

**Lupa password?** CMS tidak punya tombol "lupa password". Hubungi **Super Admin** BPI. Super Admin dapat membuatkan password baru untuk Anda (lihat bab [Role Management](bab:role)). Setelah bisa masuk, segera ganti password tersebut di menu **Profile** (lihat bab [Profil & Keamanan Akun](bab:akun)).

## Cara keluar (logout)

Ada dua cara:

- Klik **Logout** di bagian paling bawah menu kiri (sidebar), atau
- Klik lingkaran berisi inisial nama Anda di pojok kanan atas, lalu pilih **Logout**.

Selalu logout jika memakai komputer yang juga dipakai orang lain.

> **Penting:** Jika CMS dibiarkan tanpa aktivitas selama sekitar **2 jam**, Anda akan otomatis keluar. Isian formulir yang belum disimpan akan **hilang**. Jika sedang menulis teks panjang (misalnya berita), simpan secara berkala, atau tulis dulu di Word/Google Docs lalu salin ke CMS.

## Mengenal tampilan CMS

Setelah login, layar CMS terbagi menjadi tiga bagian. Nomor pada gambar di bawah sesuai dengan nomor pada tabel.

![Tampilan CMS setelah login: (1) bilah atas, (2) sidebar, (3) area kerja, (4) tombol Page Guide](/images/panduan/tampilan-cms.webp)

| Bagian | Letak | Fungsinya |
|---|---|---|
| **Bilah atas** | Paling atas, berwarna merah marun | Berisi logo BPI dan nama Anda. Di HP/tablet ada tombol ☰ untuk membuka menu. |
| **Sidebar (menu kiri)** | Sisi kiri, berwarna biru tua | Daftar semua menu yang boleh Anda buka. Menu yang sedang dibuka ditandai garis emas. |
| **Area kerja** | Tengah | Tempat Anda melihat, menambah, dan mengubah data. |

Di pojok kanan bawah sebagian besar halaman ada tombol **❓ Page Guide**. Klik tombol itu untuk langsung membuka bab panduan yang menjelaskan halaman yang sedang Anda buka.

### Pola halaman yang sama di semua menu

Hampir semua menu memakai pola yang sama. Begitu paham satu menu, Anda akan mudah memahami menu lainnya. Setiap menu dibuka dengan **halaman daftar**, yaitu tabel berisi semua data (misalnya semua banner). Di halaman ini ada empat tombol penting:

![Halaman daftar Banner: (1) tombol Add Banner, (2) ikon edit, (3) ikon hapus, (4) label status](/images/panduan/pola-halaman-daftar.webp)

1. Tombol **Add …** (misalnya **Add Banner**) di kanan atas untuk **menambah** data baru.
2. Ikon **pensil** (✏️) di kolom *Action* untuk **mengubah** (Edit) data.
3. Ikon **tempat sampah** (🗑️) di kolom *Action* untuk **menghapus** data.
4. Label **Active / Inactive** di kolom *Status*. Klik label ini untuk menampilkan atau menyembunyikan data dari website.

Penjelasan rinci tentang keempat hal ini ada di bab [Konsep Dasar](bab:dasar).

## Dashboard

**Dashboard** adalah halaman pertama setelah login. Isinya:

- **Kotak angka**: jumlah Banner, bagian Homepage, Stakeholder, Program, Proyek, dan bahasa aktif. Klik **View All** untuk membuka menu terkait.
- **Latest Banners / Latest Homepages / Latest Projects**: data yang paling baru ditambahkan.
- **Quick Actions**: jalan pintas untuk menambah Banner, bagian Homepage, Proyek, atau membuka pengaturan bahasa.
- **System Information**: informasi teknis untuk tim IT. Bagian ini bisa Anda abaikan.

> **Catatan:** Jika Anda login sebagai **Editor**, sebagian tombol di Dashboard mengarah ke menu yang bukan wewenang Editor. Jika diklik, akan muncul halaman "403" atau "tidak punya akses". Ini normal. Editor cukup memakai menu **News**.

## Hak akses (role)

Setiap akun punya satu **role** yang menentukan menu apa saja yang boleh dibuka:

| Role | Siapa | Boleh mengelola |
|---|---|---|
| **Super Admin** | Pengelola utama / tim teknis | Semua menu, termasuk **Role Management** (kelola akun) dan **API Documentation**. |
| **Admin** | Staf pengelola website BPI | Semua isi website: Banner, Homepage, About, Partners, Stakeholder, Programs, Projects, News, Org. Structure, Contact, Contact Messages, Menu, Footer & Legal, Language Settings, Shortlink, dan QR Code. |
| **Editor** | Penulis / redaksi berita | Hanya **News**: berita, kategori berita, tag, dan galeri berita. |

Role Anda tertulis di kartu kecil di bagian bawah sidebar, di bawah nama Anda. Jika butuh akses tambahan, hubungi Super Admin.

## Daftar menu dan artinya

Nama menu di CMS memakai bahasa Inggris. Berikut artinya:

| Menu di CMS | Artinya | Bab panduan |
|---|---|---|
| Dashboard | Halaman ringkasan | Bab ini |
| Banner | Gambar besar di bagian atas tiap halaman | [Banner](bab:banner) |
| Homepage | Halaman depan (Beranda) | [Homepage](bab:beranda) |
| About | Tentang Kami, Visi & Misi | [About](bab:tentang) |
| Partners | Mitra kerja sama | [Partners](bab:mitra) |
| Stakeholder | Asosiasi / pemangku kepentingan | [Stakeholder](bab:stakeholder) |
| Programs | Program strategis & peta jalan | [Programs & Roadmap](bab:program) |
| Projects | Proyek kolaborasi | [Projects](bab:proyek) |
| News | Berita & artikel | [News](bab:berita) |
| Org. Structure | Struktur organisasi | [Org. Structure](bab:struktur) |
| Contact | Informasi kontak | [Contact](bab:kontak) |
| Contact Messages | Pesan masuk dari pengunjung | [Contact Messages](bab:pesan-kontak) |
| Menu | Menu navigasi website | [Menu](bab:menu) |
| Footer & Legal | Bagian bawah website & halaman hukum | [Footer & Legal](bab:footer-legal) |
| Language Settings | Pengaturan bahasa | [Language Settings](bab:bahasa) |
| Shortlink | Tautan pendek | [Shortlink](bab:shortlink) |
| QR Code | Kode QR | [QR Code](bab:qrcode) |
| Role Management | Kelola akun pengguna CMS | [Role Management](bab:role) |
| Guide | Buku panduan ini | – |
| Profile | Profil & password Anda | [Profil & Keamanan Akun](bab:akun) |

Menu yang tidak sesuai dengan role Anda tidak akan muncul di sidebar.
