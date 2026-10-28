Menu **Partners** mengelola daftar **mitra kerja sama** BPI beserta logonya. Logo mitra tampil di halaman depan (bagian *Mitra Kami*) dan di halaman **Stakeholders** (tab *Mitra Strategis*), dikelompokkan berdasarkan kategori.

Buka menu: [Partners](cms:admin.mitra.index)

Menu ini punya tiga bagian:

| Bagian | Tombol di halaman Partners | Fungsinya |
|---|---|---|
| **Daftar mitra** | (halaman utama) | Nama, logo, kategori, dan website setiap mitra |
| **Partner Categories** | **Manage Partner Categories** | Kelompok mitra, misalnya Mitra Strategis, Internasional, Industri |
| **Partner Page Intro** | **Partner Page Intro** | Judul dan deskripsi pembuka bagian mitra di halaman Stakeholders |

## Langkah awal: siapkan kategori mitra

Setiap mitra **wajib** masuk satu kategori. Jadi pastikan kategorinya sudah ada sebelum menambah mitra.

1. Di halaman Partners, klik **Manage Partner Categories**.
2. Klik **Add Category**.
3. Isi:
   - **Slug / Category Code**: kode singkat tanpa spasi, misalnya `strategis` atau `internasional`. Boleh dikosongkan agar dibuat otomatis dari nama kategori.
   - **Display Order**: urutan kelompok di website.
   - **Status: Active**: centang agar kategori bisa dipilih.
   - **Category Name** di tab **ID** dan **EN**, misalnya *Mitra Strategis* / *Strategic Partner*.
4. Klik **Save Category**.

> **Perhatian:** Mitra terhubung ke kategorinya melalui **slug** (kode kategori). Jangan mengubah slug kategori yang sudah dipakai. Jika slug diubah, mitra-mitra dalam kategori itu kehilangan kelompoknya dan harus diedit ulang satu per satu. Mengubah **nama** kategori aman dilakukan.

Kategori berstatus **Inactive** tidak muncul sebagai pilihan saat menambah atau mengedit mitra.

## Menambah mitra

1. Di halaman Partners, klik **Add Partner**.
2. Pilih **Partner Category**.
3. (Opsional) Isi **Website URL** mitra, lengkap dengan `https://`, misalnya `https://example-partner.com`.
4. Isi **Display Order** (urutan logo di dalam kategorinya) dan centang **Display Status: Active**.
5. Pada tab **ID**, isi **Partner Name**. Isi juga pada tab **EN** (biasanya sama).
6. Pada **Partner Logo**, pilih file logo.
7. Klik **Save Partner**.

> **Tips:** Gunakan logo berformat **PNG berlatar transparan** agar menyatu dengan warna latar website. Potong ruang kosong di sekitar logo agar semua logo terlihat sama besar. Logo akan otomatis dikecilkan maksimal 600 piksel.

Di halaman daftar, mitra diurutkan berdasarkan **kategori**, lalu **urutan**, lalu **nama**.

## Mengubah atau menyembunyikan mitra

- **Mengubah:** klik ✏️, ubah data, lalu klik **Update Partner**. Untuk mengganti logo, cukup pilih file baru.
- **Menyembunyikan:** klik label **Active** sampai berubah menjadi **Inactive**. Logo mitra tidak akan tampil di website.

> **Penting:** Mitra juga bisa dipilih sebagai **kolaborator** di menu [Projects](bab:proyek). Jika mitra dihapus, mitra itu juga hilang dari daftar kolaborator semua proyek. Jika kerja sama hanya berhenti sementara, gunakan status **Inactive**.

## Partner Page Intro (teks pembuka bagian mitra)

Bagian ini mengatur **judul dan deskripsi** di atas daftar logo mitra pada halaman Stakeholders.

1. Di halaman Partners, klik **Partner Page Intro**.
2. Isi di setiap tab bahasa:
   - **Section Title (Badge)**: label kecil, misalnya *Mitra Kami*.
   - **Subheadline / Main Headline**: judul besar, misalnya *Kolaborasi Membangun Masa Depan Perfilman Indonesia*.
   - **Full Description**: paragraf penjelasan.
3. Centang **Display Status**. Jika tidak dicentang, website menampilkan teks judul bawaan.
4. Klik **Save Intro Settings**.

> **Catatan:** Kolom **Intro Photo / Image** tersedia, tetapi tampilan website saat ini **belum menampilkan** foto tersebut.
