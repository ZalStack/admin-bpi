Menu **QR Code** membuat **kode QR berlogo BPI** yang siap dicetak di poster, spanduk, undangan, atau materi presentasi. Saat dipindai dengan kamera HP, kode ini membuka alamat web tertentu.

Buka menu: [QR Code](cms:admin.qrcode.index)

## Shortlink atau Custom URL?

Sebelum membuat QR Code, tentukan isinya:

| Pilihan | Kelebihan | Kekurangan |
|---|---|---|
| **Shortlink** *(disarankan)* | Tujuan bisa diganti **setelah dicetak**, dan jumlah scan tercatat | Shortlink harus dibuat dulu di menu [Shortlink](bab:shortlink) |
| **Custom URL** | Langsung jadi tanpa membuat shortlink | Tujuan **tidak bisa diganti** setelah dicetak, dan jumlah scan tidak tercatat |

> **Tips:** Untuk materi cetak (poster, spanduk, brosur), **selalu gunakan Shortlink**. Jika alamat tujuan berubah, misalnya formulir pendaftaran diganti, cukup ubah tujuan shortlink tanpa mencetak ulang.

## Membuat QR Code

1. Klik **Add QR Code**.
2. Isi **Title** (wajib): nama internal yang juga dipakai sebagai **nama file** saat diunduh, misalnya *Spanduk Rapat Tahunan 2026*.
3. Pada **QR Content**, pilih:
   - **Shortlink**, lalu pilih shortlink dari daftar. Tujuannya tampil di bawah daftar (**Redirects to:**), atau
   - **Custom URL**, lalu isi **Destination URL** lengkap dengan `https://`.
4. Pada **Style**, pilih **QR Color** (warna kode) dan **Background Color** (warna latar).
5. Pada **Center Logo**, pilih:
   - **BPI Logo**: logo BPI di tengah kode (bawaan),
   - **Upload Logo**: unggah logo lain (PNG transparan, JPG, atau WEBP, maksimal 1 MB), atau
   - **No Logo**: tanpa logo.
6. (Opsional) Isi **Caption**: teks di bawah kode, misalnya *Pindai untuk mendaftar* (maksimal 60 karakter).
7. Lihat hasilnya di **Live Preview**.
8. Klik **Save QR Code**.

## Mengunduh QR Code

Di halaman daftar QR Code (atau di **Live Preview** formulir), klik:

- **PNG**: gambar biasa, cocok untuk dokumen, presentasi, dan media sosial.
- **SVG**: format yang tetap tajam di ukuran berapa pun, cocok untuk **spanduk dan materi cetak besar**. Berikan file SVG ke percetakan atau desainer.

File hasil unduhan berukuran 1024 piksel dan siap cetak.

## Agar QR Code mudah dipindai

- Gunakan warna kode **gelap** di atas latar **terang**, misalnya hitam atau marun di atas putih. Jangan dibalik, dan hindari dua warna yang mirip.
- Cetak dengan ukuran minimal **2,5 × 2,5 cm**. Untuk spanduk yang dilihat dari jauh, buat jauh lebih besar.
- Sisakan ruang kosong di sekeliling kode, dan jangan menumpuk kode di atas foto.
- **Selalu uji pindai** dengan 2–3 HP berbeda sebelum mencetak dalam jumlah banyak.

> **Penting:** Jika QR Code memakai shortlink yang berstatus **Inactive**, hasil pindai akan menampilkan halaman "tidak ditemukan". Halaman daftar QR Code menandai kondisi ini dengan label **Shortlink inactive**.

## Halaman daftar QR Code

Setiap baris menampilkan pratinjau kode, judul, isi, caption, dan target. Untuk QR Code yang memakai shortlink, tertera juga **jumlah scan/klik**. Gunakan ✏️ untuk mengubah tampilan atau tujuan QR Code, dan 🗑️ untuk menghapusnya.

> **Catatan:** Menghapus QR Code di CMS **tidak** mematikan kode yang sudah dicetak. Kode QR yang memakai shortlink akan tetap berfungsi selama shortlink-nya masih aktif.
