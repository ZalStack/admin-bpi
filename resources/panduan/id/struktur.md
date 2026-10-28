Menu **Org. Structure** mengelola **anggota pengurus BPI**: pimpinan, dewan, bidang, komite, satuan tugas (satgas), dan kelompok kerja (pokja). Data ini membentuk **bagan struktur organisasi** di halaman About website.

Buka menu: [Org. Structure](cms:admin.struktur.index)

Di halaman ini ada tiga tombol utama:

| Tombol | Fungsinya |
|---|---|
| **Add Member** | Menambah anggota baru |
| **Chart Layout** | Mengatur posisi kotak bidang dan unit di bagan |
| **Section Texts** | Mengubah judul dan label bagian struktur organisasi (lihat [Teks Halaman](bab:teks-halaman)) |

## Memahami pengelompokan anggota

Posisi seseorang di bagan ditentukan oleh tiga isian: **Category**, **Sub-Category**, dan **Hierarchy Level**. Pilihan di ketiga isian ini berbahasa Inggris, dengan istilah resmi BPI di dalam kurung, misalnya **Core Leadership (Pimpinan Inti)**.

Gambar berikut menunjukkan bagan di website. Di kiri: **Majelis Dewan** (Dewan Pengawas, Dewan Penasehat, Dewan Pakar) mengapit **Pimpinan Inti** (Ketua Umum), dengan Sekretaris Jenderal, Bendahara Umum, dan Wakil Sekjen di bawahnya. Di kanan: kotak-kotak **Bidang Strategis**, lalu kotak **Komite, Pokja, dan Satgas**.

![Bagan struktur organisasi di website: Majelis Dewan, Pimpinan Inti, Sekretariat dan Perbendaharaan, Bidang-Bidang Strategis, serta Komite, Pokja, dan Satgas](/images/panduan/bagan-website.webp)

**Category** adalah kelompok besar:

| Category (pilihan di form) | Artinya |
|---|---|
| **Core Leadership** (Pimpinan Inti) | Ketua Umum, Sekretaris Jenderal, Bendahara Umum, Wakil Sekjen |
| **Councils** (Majelis Dewan) | Dewan Pengawas, Dewan Penasehat, Dewan Pakar |
| **Strategic Departments** (Bidang Strategis BPI) | Ketua dan anggota bidang-bidang (Bidang Organisasi, Bidang Festival, dll.) |
| **Taskforces & Working Groups** (Satgas & Pokja BPI) | Satuan Tugas dan Kelompok Kerja |
| **Committees** (Komite BPI) | Komite, misalnya Komite Festival Film Indonesia |

**Hierarchy Level** adalah tingkatan di dalam kelompok:

| Level | Untuk |
|---|---|
| **Tier 1 - Chairperson / Council Member** | Ketua Umum / anggota Dewan |
| **Tier 2 - Secretary-General / Treasurer / Deputy Secretary-General** | Sekjen / Bendahara Umum / Wakil Sekjen |
| **Tier 3 - Head of Department / Unit** | Ketua Bidang / Ketua Unit (Satgas, Pokja, Komite) |
| **Tier 4 - Member** | Anggota |

### Contoh pengisian yang benar

Gunakan tabel ini sebagai acuan. Isiannya mengikuti data yang sudah ada di CMS. Kolom Category dan Sub-Category ditulis singkat, tanpa keterangan dalam kurung:

| Jabatan | Category | Sub-Category | Level | Department / Unit |
|---|---|---|---|---|
| Ketua Umum | Core Leadership | Core Leadership | Tier 1 | Pimpinan Inti |
| Sekretaris Jenderal | Core Leadership | Core Leadership | Tier 2 | Sekretariat Jenderal |
| Bendahara Umum | Core Leadership | Core Leadership | Tier 2 | Kebendaharaan Umum |
| Wakil Sekjen Bidang … | Core Leadership | Deputy Secretary-General | Tier 2 | Sekretariat Jenderal |
| Anggota Dewan Pengawas | Councils | Supervisory Council | Tier 1 | Dewan Pengawas |
| Anggota Dewan Penasehat | Councils | Advisory Council | Tier 1 | Dewan Penasehat |
| Anggota Dewan Pakar | Councils | Expert Council | Tier 1 | Dewan Pakar |
| Ketua Bidang Festival | Strategic Departments | Department | Tier 3 | Bidang Festival |
| Anggota Bidang Festival | Strategic Departments | Department | Tier 4 | Bidang Festival |
| Ketua Pokja Revisi UU Perfilman | Taskforces & Working Groups | Working Group | Tier 3 | Pokja Revisi UU Perfilman |
| Anggota Pokja Revisi UU Perfilman | Taskforces & Working Groups | Working Group | Tier 4 | Pokja Revisi UU Perfilman |
| Ketua Satgas Anti Pembajakan | Taskforces & Working Groups | Taskforce | Tier 3 | Satgas Anti Pembajakan |
| Ketua Komite FFI 2026 | Committees | Committee | Tier 3 | Komite Festival Film Indonesia 2026 |

> **Penting:** Anggota bidang, satgas, pokja, dan komite **dikelompokkan berdasarkan nama di kolom Department / Unit** (tab ID). Nama tersebut harus **sama persis** untuk semua anggota satu bidang atau satu unit, termasuk huruf besar-kecil dan spasi. Contoh: jika ketua diisi *Bidang Festival* tetapi anggotanya *Bidang festival* atau *Bidang  Festival* (dua spasi), bagan akan menampilkan **dua kotak terpisah**. Agar aman, pilih nama dari daftar saran yang muncul saat Anda mulai mengetik.

## Menambah anggota

1. Klik **Add Member**.
2. Isi **Full Name** (wajib), lengkap dengan gelar jika perlu.
3. Pilih **Category**, **Sub-Category**, dan **Hierarchy Level** sesuai tabel contoh di atas.
4. (Opsional) Isi kontak: **Email**, **LinkedIn URL**, **Instagram URL**, dan **Phone / WhatsApp**. Untuk LinkedIn dan Instagram, gunakan alamat lengkap, misalnya `https://instagram.com/namapengguna`.
5. Isi **Display Order**, yaitu urutan kartu di dalam tingkatannya (1, 2, 3, dan seterusnya).
6. Centang **Status: Active (Visible on Website)**.
7. Pada tab **ID**, isi:
   - **Position / Jabatan** (wajib): misalnya *Ketua Bidang Festival*.
   - **Department / Unit**: misalnya *Bidang Festival*. Saat mulai mengetik, akan muncul daftar saran; pilih dari daftar itu jika ada.
   - **Biography / Profile Description** (opsional): profil singkat.
8. Pada tab **EN**, isi versi Inggris, misalnya *Head of Festival Department* dan *Festival Department*.
9. Pada **Official Photo**, pilih foto resmi.
10. Klik **Save Member**.

> **Tips foto pengurus:** Gunakan foto **potret atau persegi** dengan wajah di tengah dan latar polos. Usahakan semua foto punya gaya yang seragam (latar, pencahayaan, dan jarak kamera) agar bagan terlihat rapi. Foto akan dikecilkan otomatis maksimal 1000 piksel.

## Mengubah atau menonaktifkan anggota

- **Mengubah:** klik ✏️, ubah data, lalu klik **Update Member**.
- **Pengurus berganti:** jika ada pergantian pengurus, Anda bisa **mengubah** nama, foto, dan biodata pada data jabatan tersebut, atau membuat anggota baru lalu menjadikan anggota lama **Inactive**.
- **Menyembunyikan:** klik label **Active** sampai berubah menjadi **Inactive**.

## Mengatur tata letak bagan (Chart Layout)

Halaman **Chart Layout** dipakai untuk mengatur **urutan kotak bidang** dan **urutan kotak unit** (komite, satgas, pokja) di bagan website, tanpa perlu mengubah angka urutan satu per satu.

1. Di halaman Org. Structure, klik **Chart Layout**.
2. Pada tab **BPI Departments**, kotak-kotak bidang ditampilkan dalam tiga baris, sama seperti di website:
   - **Row 1**: slot 1–5 (bidang utama, maksimal 5 kotak)
   - **Row 2**: slot 6–10
   - **Row 3**: slot 11 dan seterusnya (rata tengah di bagian bawah)
3. Klik tombol panah **‹** (geser ke kiri) atau **›** (geser ke kanan) di pojok kanan atas sebuah kotak untuk menukar posisinya dengan kotak di sebelahnya. Nomor slot kotak (**Slot #1**, **Slot #2**, dan seterusnya) akan ikut berubah.
4. Klik tab **Committees, Taskforces & Working Groups**, lalu atur urutan kotak komite, satgas, dan pokja dengan cara yang sama.
5. Klik **Save Layout** di kanan atas. Tunggu sampai muncul pesan bahwa susunan berhasil disimpan.
6. Klik **Members List** untuk kembali ke daftar anggota.

![Halaman Chart Layout: tab BPI Departments berisi kotak bidang di Row 1, Row 2, dan Row 3, masing-masing dengan tombol panah, serta tombol Save Layout di kanan atas](/images/panduan/chart-layout.webp)

> **Catatan:** Chart Layout hanya menampilkan anggota berstatus **Active**. Bidang atau unit yang tidak muncul di sini kemungkinan belum punya anggota aktif, atau nama Department / Unit-nya berbeda (lihat kotak **Penting** di atas).

> **Penting:** Menyimpan Chart Layout akan **mengubah angka Display Order** anggota sesuai posisi kotaknya. Ini normal. Jika Anda mengatur susunan lewat Chart Layout, sebaiknya tidak mengubah lagi angka Display Order secara manual untuk anggota bidang dan unit.
