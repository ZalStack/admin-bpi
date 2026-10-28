**Shortlink** (tautan pendek) mengubah alamat web yang panjang menjadi alamat pendek yang mudah diingat dan dibagikan, menggunakan domain website BPI.

**Contoh:** alamat panjang `https://docs.google.com/forms/d/e/1FAIpQLSf.../viewform` bisa dipendekkan menjadi `bpi.or.id/daftar-ffi-2026`.

Kegunaannya:

- Mudah dibagikan di media sosial, WhatsApp, poster, atau presentasi.
- **Jumlah klik tercatat otomatis**, jadi Anda bisa tahu berapa kali tautan dibuka.
- **Alamat tujuan bisa diganti kapan saja** tanpa mengubah tautan pendeknya. Ini berguna untuk QR Code yang sudah telanjur dicetak.

Buka menu: [Shortlink](cms:admin.shortlink.index)

## Membuat shortlink

1. Klik **Add Shortlink**.
2. Isi **Destination URL** (wajib): alamat lengkap tujuan, diawali `https://`.
3. Isi **Short Code**: bagian akhir tautan pendek, misalnya `laporan-tahunan-2026`.
   - Panjangnya 3–50 karakter dan hanya boleh berisi **huruf kecil, angka, dan tanda hubung (-)**.
   - Boleh dikosongkan. Sistem akan membuat kode acak, misalnya `x7k2p9`.
   - Pratinjau **Short URL** tampil di bawah kolom ini.
4. (Opsional) Isi **Title / Note**: catatan internal agar mudah dikenali, misalnya *Formulir Pendaftaran FFI 2026*.
5. Centang **Status: Active**.
6. Klik **Save Shortlink**.

> **Catatan:** Beberapa kode **tidak bisa dipakai** karena sudah digunakan oleh halaman website, misalnya `about`, `contact`, `news`, `project`, `berita`, `kontak`, `admin`, dan `login`. Jika muncul pesan *"This code is reserved…"*, pilih kode lain.

## Halaman daftar shortlink

Di bagian atas tertera jumlah shortlink dan **total klik**. Setiap baris menampilkan:

- **Short Link**: tautan pendek. Klik ikon salin untuk menyalinnya.
- **Destination**: alamat tujuan.
- **Clicks**: jumlah klik dan kapan terakhir diklik.
- **Status**: Active / Inactive. Shortlink yang **Inactive** akan menampilkan halaman "tidak ditemukan" jika dibuka.
- **Action**: ikon QR Code, ✏️ Edit, 🗑️ Hapus.

### Membuat QR Code cepat dari shortlink

Klik ikon **QR Code** pada baris shortlink. Akan muncul jendela berisi QR Code dengan tombol:

- **Download PNG** / **Download SVG**: unduh QR Code standar.
- **Customize & save as QR Code →**: membuat QR Code dengan warna, logo, dan keterangan sendiri. Lihat bab [QR Code](bab:qrcode).

## Mengubah shortlink

- **Mengganti tujuan:** klik ✏️, ubah **Destination URL**, lalu simpan. Tautan pendek dan QR Code yang sudah dicetak akan otomatis mengarah ke tujuan baru.
- **Mengganti kode:** klik ✏️, lalu ubah **Short Code**. Baca peringatan di bawah sebelum melakukannya.

> **Perhatian:** Mengubah **Short Code** akan membuat tautan lama **tidak berfungsi lagi**, termasuk tautan yang sudah dibagikan dan QR Code yang sudah dicetak. Ganti kode hanya jika tautan tersebut belum pernah disebarkan.

## Menghapus shortlink

Shortlink yang **masih dipakai oleh QR Code** tidak bisa dihapus. Akan muncul pesan bahwa QR Code terkait harus diubah atau dihapus terlebih dahulu. Jika hanya ingin menghentikan tautan, ubah statusnya menjadi **Inactive**.
