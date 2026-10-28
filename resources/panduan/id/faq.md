Kumpulan masalah yang paling sering ditemui beserta cara mengatasinya. Jika masalah Anda tidak ada di sini, lihat bagian [Menghubungi tim teknis](#menghubungi-tim-teknis) di akhir bab ini.

## Login dan akun

**Saya tidak bisa login dan muncul tulisan "Incorrect email or password".**
Periksa ejaan email, pastikan **Caps Lock** tidak menyala, lalu klik ikon mata untuk melihat password yang Anda ketik. Jika tetap gagal, minta Super Admin mereset password Anda.

**Saya sudah mencoba berkali-kali dan tidak bisa login lagi.**
Demi keamanan, login dibatasi 5 kali percobaan per menit. Tunggu sekitar 1 menit, lalu coba lagi dengan teliti.

**Saya tiba-tiba keluar dan isian formulir saya hilang.**
Sesi login berakhir otomatis jika CMS tidak dipakai sekitar 2 jam. Login kembali, lalu ulangi isian. Untuk teks panjang, tulis dulu di Word/Google Docs, atau simpan secara berkala.

**Muncul halaman "403" atau tulisan "tidak punya akses".**
Halaman tersebut bukan wewenang role Anda (misalnya Editor membuka menu Banner). Jika Anda memang membutuhkan aksesnya, hubungi Super Admin.

**Muncul halaman "419 Page Expired" saat menekan simpan.**
Halaman terlalu lama dibiarkan terbuka. Muat ulang halaman (F5), login jika diminta, lalu isi ulang dan simpan.

## Menyimpan data

**Saya menekan simpan, tetapi data tidak tersimpan dan muncul kotak merah.**
Ada isian yang kurang atau salah. Baca daftar kesalahan di kotak merah (artinya dijelaskan di [Konsep Dasar](bab:dasar#2-kolom-wajib-dan-pesan-kesalahan)). Periksa juga tab bahasa yang bertanda **titik merah**.

**Setelah gagal simpan, gambar yang tadi saya pilih hilang.**
Ini normal. Demi keamanan, browser tidak menyimpan pilihan file. Pilih ulang gambarnya, lalu simpan lagi.

**Gambar saya ditolak.**
Kemungkinan file lebih besar dari 2 MB atau formatnya tidak didukung (misalnya SVG, HEIC dari iPhone, atau PDF). Ubah ke JPG/PNG dan perkecil ukurannya. Caranya dijelaskan di [Konsep Dasar](bab:dasar#5-mengunggah-gambar).

**Saya tidak sengaja menghapus data. Apakah bisa dikembalikan?**
Data yang sudah dihapus tidak bisa dikembalikan dari CMS. Segera hubungi tim teknis. Mereka mungkin bisa memulihkannya dari cadangan (*backup*) database, jika tersedia. Untuk ke depannya, gunakan status **Inactive** atau **Draft** daripada menghapus.

## Tampilan di website

**Saya sudah menyimpan, tetapi website belum berubah.**
1. Pastikan statusnya **Active** atau **Published**.
2. Muat ulang halaman website dengan **Ctrl + F5**, atau buka di jendela penyamaran (*Incognito*).
3. Pastikan Anda melihat **bahasa** yang benar (ID atau EN).
4. Jika setelah beberapa menit tetap belum berubah, hubungi tim teknis.

**Versi bahasa Inggris website masih menampilkan teks bahasa Indonesia.**
Tab **EN** pernah dikosongkan saat disimpan, sehingga isinya disalin dari teks Indonesia. Buka data tersebut di CMS, ganti isi tab **EN** dengan terjemahan bahasa Inggris, lalu simpan. Lihat [Konsep Dasar](bab:dasar#1-isi-dua-bahasa-tab-bahasa).

**Berita saya tidak muncul di website.**
Periksa statusnya di menu News. Harus **Published**, bukan Draft atau Archived.

**Logo mitra tidak muncul.**
Periksa apakah mitra dan **kategori mitranya** berstatus **Active**, dan apakah logonya sudah diunggah.

**Anggota struktur organisasi tampil di kotak bidang yang salah, atau satu bidang terpecah menjadi dua kotak.**
Nama **Department / Unit** antaranggota tidak sama persis. Lihat penjelasan di bab [Org. Structure](bab:struktur#memahami-pengelompokan-anggota).

**Label warna kategori berita hilang.**
Kemungkinan judul kategori pernah diubah. Edit berita tersebut, pilih ulang kategorinya di setiap tab bahasa, lalu simpan. Lihat bab [News](bab:berita#kategori-berita).

**Shortlink atau QR Code membuka halaman "tidak ditemukan".**
Periksa apakah shortlink berstatus **Active** dan apakah **Short Code**-nya pernah diubah. Lihat bab [Shortlink](bab:shortlink).

## Menghubungi tim teknis

Hubungi tim teknis atau developer jika:

- Terjadi error yang tidak dijelaskan di panduan ini (misalnya halaman "500 Server Error").
- Data terhapus dan perlu dipulihkan.
- Perlu menambah fitur, halaman, atau bahasa baru di website.
- Email pemberitahuan pesan kontak tidak pernah masuk.

**Agar masalah cepat ditangani, sertakan informasi berikut:**

1. Menu dan halaman yang sedang dibuka. Salin juga alamat dari kolom alamat browser.
2. Apa yang sedang Anda lakukan, misalnya "menyimpan berita baru dengan gambar 1,5 MB".
3. **Tangkapan layar (screenshot)** pesan kesalahan. Di Windows, tekan **Windows + Shift + S**.
4. Waktu kejadian (tanggal dan jam).
