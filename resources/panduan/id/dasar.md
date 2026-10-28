Bab ini menjelaskan hal-hal yang **berlaku di semua menu**. Luangkan waktu 10 menit untuk membacanya. Setelah itu, bab-bab lain akan jauh lebih mudah dipahami.

## 1. Isi dua bahasa (tab bahasa)

Website BPI tersedia dalam **Bahasa Indonesia** dan **Bahasa Inggris**. Karena itu, hampir setiap formulir di CMS punya **tab bahasa** seperti ini:

`ID · Bahasa Indonesia  Default`   `EN · English`

- Klik tab **ID** untuk mengisi teks versi Indonesia, lalu klik tab **EN** untuk mengisi versi Inggris.
- Tab bertanda **Default** adalah bahasa utama website (saat ini Bahasa Indonesia).
- Isi kedua tab tersimpan bersamaan saat Anda menekan tombol simpan **satu kali**. Tidak perlu menyimpan per tab.
- Kolom yang tidak tergantung bahasa (misalnya gambar, urutan, status, tahun) ada di luar tab dan cukup diisi sekali.

**Bagaimana jika tab EN dikosongkan?** Data tetap bisa disimpan. Saat Anda menekan simpan, setiap kolom di tab **EN** yang kosong **otomatis diisi salinan teks dari tab ID**. Akibatnya, pengunjung yang memilih bahasa Inggris akan melihat teks **bahasa Indonesia** pada kolom-kolom tersebut. Website tidak akan tampil kosong, tetapi sebaiknya kedua bahasa tetap diisi agar tampilan konsisten.

Ada dua hal yang perlu diingat:

- Setelah disimpan, tab **EN** berisi **salinan** teks Indonesia, jadi saat formulir dibuka lagi kolom EN tidak tampak kosong. Isi kolom itu dengan terjemahan bahasa Inggris kapan saja, lalu simpan.
- Salinan **tidak ikut berubah** jika nanti Anda mengubah teks di tab ID. Setelah mengubah teks Indonesia, perbarui juga tab EN, atau **kosongkan** kolom EN-nya lalu simpan agar disalin ulang dari teks Indonesia yang baru.

> **Catatan:** Aturan ini **tidak berlaku** untuk [Teks Halaman (Page Texts)](bab:teks-halaman) serta Footer & Legal. Di sana, kolom yang dikosongkan berarti website memakai **teks bawaannya sendiri**.

> **Tips:** Tulis dan periksa versi Indonesia lebih dulu, lalu terjemahkan ke bahasa Inggris. Untuk menerjemahkan, Anda bisa memakai Google Translate atau DeepL, tetapi selalu baca ulang hasilnya, terutama untuk nama jabatan, nama lembaga, dan istilah perfilman.

> **Penting:** Jika ada **titik merah** pada salah satu tab bahasa setelah Anda menekan simpan, berarti ada isian yang salah atau kurang **di tab itu**. Klik tab tersebut untuk melihat kolom mana yang bermasalah. Contohnya bisa dilihat pada gambar di bagian 2 di bawah.

## 2. Kolom wajib dan pesan kesalahan

Kolom yang ditandai **bintang merah (\*)** wajib diisi. Pada tab bahasa, tanda wajib hanya berlaku untuk **bahasa Default** (ID). Tab bahasa lain (EN) boleh dikosongkan; isinya akan disalin dari tab ID, seperti dijelaskan di bagian 1.

Jika ada yang salah saat menyimpan, data **tidak tersimpan**. Pada contoh di bawah, form **Add Banner** disimpan tanpa judul dan deskripsi, dan muncul tiga penanda:

- kotak merah di bagian atas halaman bertuliskan **"There are errors in the form:"** beserta daftar kesalahannya,
- **titik merah** pada tab bahasa yang isiannya bermasalah (di contoh ini hanya tab **ID**, karena tab EN boleh dikosongkan), dan
- tulisan merah tepat di bawah kolom yang bermasalah.

![Form Add Banner yang gagal disimpan: kotak merah berisi daftar kesalahan, titik merah di tab bahasa, dan pesan di bawah kolom Title](/images/panduan/pesan-kesalahan.webp)

Pesan kesalahan sering menyebut **nama teknis** kolom. Cara membacanya: `translations.id.judul` berarti kolom **Title / Judul** di tab **ID**, sedangkan `translations.en.deskripsi` berarti kolom **Description / Deskripsi** di tab **EN**.

Berikut arti pesan yang paling sering muncul:

| Pesan di layar | Artinya | Yang perlu dilakukan |
|---|---|---|
| *The … field is required.* | Kolom wajib belum diisi | Isi kolom tersebut |
| *The … must not be greater than 2048 kilobytes.* | File gambar terlalu besar (lebih dari 2 MB) | Perkecil ukuran gambar, lihat bagian 5 di bawah |
| *The … must be a file of type: …* / *must be an image* | Format file tidak diterima | Gunakan JPG, PNG, WEBP, atau GIF |
| *The … must be a valid URL.* | Alamat tautan tidak lengkap | Awali dengan `https://`, misalnya `https://bpi.or.id` |
| *The … has already been taken.* / *already in use* | Isian sudah dipakai data lain | Gunakan isian lain |
| *The … must not be greater than 255 characters.* | Teks terlalu panjang | Persingkat teks |
| *The … must be a valid email address.* | Format email salah | Periksa penulisan email, misalnya `nama@bpi.or.id` |

> **Tips:** Setelah gagal simpan, isian yang sudah Anda ketik biasanya tetap ada, **kecuali file gambar**. Pilih ulang file gambarnya sebelum menekan simpan lagi.

## 3. Status tampil: Active / Inactive

Hampir setiap data punya status:

- **Active** (hijau) artinya **tampil** di website.
- **Inactive** (abu-abu) artinya **disembunyikan** dari website, tetapi datanya **tetap tersimpan** di CMS.

Cara mengubahnya:

- **Paling cepat:** di halaman daftar, **klik label Active/Inactive** pada baris data tersebut. Status langsung berubah tanpa perlu menekan simpan.
- **Lewat formulir:** buka Edit, centang atau hapus centang kotak **Active** / **Status**, lalu simpan.

> **Tips:** Ingin menyembunyikan sesuatu untuk sementara, misalnya banner acara yang sudah lewat? **Jadikan Inactive, jangan dihapus.** Jika suatu saat dibutuhkan lagi, cukup aktifkan kembali.

### Khusus News dan Projects: Draft / Published / Archived

Berita dan proyek memakai status penerbitan:

| Status | Artinya | Tampil di website? |
|---|---|---|
| **Draft** | Masih konsep / belum siap terbit | Tidak |
| **Published** | Sudah diterbitkan | **Ya** |
| **Archived** | Diarsipkan (sudah tidak relevan) | Tidak |

Di halaman daftar, mengklik label status akan mengubah **Published ↔ Draft**. Untuk memilih **Archived**, buka formulir Edit lalu pilih di kolom **Publication Status**.

> **Perhatian:** Jika label status sebuah data **Archived** diklik di halaman daftar, data itu langsung menjadi **Published** dan tampil di website. Untuk mengubah status data yang diarsipkan, gunakan formulir Edit.

## 4. Urutan tampil (Order)

Kolom **Order** atau **Display Order** menentukan urutan tampil di website. **Angka kecil tampil lebih dulu** (1, 2, 3, dan seterusnya).

> **Tips:** Beri jarak antarangka, misalnya 10, 20, 30. Jika nanti ingin menyisipkan data baru di antara dua data, Anda cukup memberi angka 15 tanpa perlu mengubah urutan data lain.

Jika dua data punya angka urutan yang sama, data yang lebih dulu dibuat akan tampil lebih dulu.

## 5. Mengunggah gambar

### Aturan file

- Format yang diterima: **JPG, PNG, WEBP, dan GIF**.
- Ukuran file maksimal **2 MB** per gambar (khusus logo QR Code: maksimal **1 MB**).
- File **SVG** (dan **HEIC** dari iPhone) **tidak diterima**. Ubah dulu menjadi PNG atau JPG. Jendela pemilihan file di CMS hanya menampilkan file berformat yang diterima.

### Yang dilakukan sistem secara otomatis

Anda tidak perlu repot mengatur ukuran gambar secara manual, karena sistem akan:

1. **Mengecilkan** gambar yang terlalu besar sesuai batas tiap menu (lihat tabel di bawah). Gambar yang lebih kecil dari batas tidak diubah ukurannya.
2. **Mengompres** gambar ke format **WebP** agar website lebih cepat dibuka. Kualitas tetap baik dan latar transparan pada PNG tetap transparan.
3. **Memberi nama file** sesuai judul atau nama data, misalnya `festival-film-indonesia-x7k2p9.webp`.
4. **Menghapus file lama** secara otomatis saat Anda mengganti gambar atau menghapus data.

### Ukuran gambar yang disarankan

| Menu | Bentuk yang disarankan | Sisi terpanjang setelah dikecilkan sistem |
|---|---|---|
| Banner | Lanskap (melebar), minimal 1920 px lebarnya | 1920 px |
| Sampul berita & proyek | Lanskap, rasio 16:9 (misalnya 1920 × 1080 px) | 1920 px |
| Galeri berita & proyek | Lanskap atau potret | 1920 px |
| Program, Roadmap, About | Lanskap | 1920 px |
| Foto struktur organisasi | Potret atau persegi, wajah di tengah | 1000 px |
| Gambar Stakeholder | Logo, persegi | 800 px |
| Logo mitra | PNG berlatar transparan | 600 px |
| Logo tengah QR Code | Persegi, PNG berlatar transparan | 512 px |

> **Tips:** Foto dari HP atau kamera biasanya berukuran 3–10 MB, jadi akan ditolak karena melebihi 2 MB. Perkecil dulu dengan situs gratis seperti **squoosh.app** atau **tinypng.com**. Cara lain: buka foto di aplikasi Paint (Windows), pilih **Resize**, ubah lebarnya menjadi 1920 piksel, lalu simpan.

### Menghapus gambar tanpa menggantinya

Pada formulir Edit, di bawah gambar yang sedang dipakai ada tombol merah **Delete Image**.

> **Perhatian:** Tombol **Delete Image** langsung menghapus gambar saat itu juga, **tanpa** perlu menekan simpan, dan tidak bisa dibatalkan. Jika hanya ingin mengganti gambar, cukup pilih file baru tanpa menekan **Delete Image**.

## 6. Memilih ikon

Beberapa data (misalnya poin misi, program, proyek, stakeholder) bisa diberi **ikon kecil**. Cara memilihnya:

1. Klik tombol **Select** di samping kolom ikon. Jendela **Select Icon Visually** akan terbuka.
2. Cari ikon dengan mengetik kata kunci **bahasa Inggris** (misalnya *film*, *camera*, *people*, *law*, *globe*, *rocket*, *money*), atau klik kategori seperti 🎬 Filmmaking, 💡 Innovation, 👥 HR & Partners, 🎓 Education, ⚖️ Regulation, dan 🌐 Global & Business.
3. Klik ikon yang diinginkan. Kode ikon (misalnya `fa-solid fa-film`) akan terisi otomatis.

Jangan mengetik kode ikon secara manual, kecuali Anda sudah paham kode ikon *Font Awesome*.

## 7. Editor teks (Rich Text Editor)

Untuk teks panjang, seperti isi berita, Kebijakan Privasi, serta Syarat & Ketentuan, CMS menyediakan editor yang mirip Microsoft Word. Tombol-tombol di bagian atasnya:

| Tombol | Fungsi |
|---|---|
| **Normal / Heading 2 / 3 / 4** | Mengubah teks menjadi judul bagian (sub-judul). Pakai Heading 2 untuk sub-judul utama. |
| **B** / *I* / U / S | Tebal, miring, garis bawah, coret |
| **A** (warna) | Warna huruf dan warna latar teks |
| Daftar bernomor / berpoin | Membuat daftar 1, 2, 3 atau daftar berpoin |
| Perataan | Rata kiri, tengah, kanan, atau kiri-kanan |
| Kutipan (") | Menampilkan teks sebagai kutipan |
| Tautan (🔗) | Menjadikan teks bisa diklik menuju alamat web tertentu |
| Hapus format (Tx) | Mengembalikan teks terpilih ke format polos |

> **Tips:** Jika menyalin teks dari Word, PDF, atau website lain, tempel dengan **Ctrl + Shift + V** agar formatnya bersih. Setelah itu, atur ulang format memakai tombol editor. Hindari terlalu banyak warna huruf agar tampilan website tetap rapi.

## 8. Menyimpan, membatalkan, dan menghapus

- **Menyimpan:** nama tombol simpan berbeda di setiap menu (misalnya **Save**, **Save Partner**, **Update News**, **Save Changes**), tetapi selalu berwarna merah marun dan berada di bagian bawah formulir. Jika berhasil, muncul kotak hijau bertuliskan *"… added successfully"* atau *"… updated successfully"*.
- **Membatalkan:** klik **Cancel** atau **Back**. Semua yang belum disimpan akan dibuang.
- **Menghapus:** klik ikon tempat sampah, lalu klik **OK** pada kotak konfirmasi *"Are you sure you want to delete this data?"*.

> **Perhatian:** Data yang sudah dihapus **hilang permanen**. CMS tidak punya "tempat sampah" untuk memulihkannya, dan gambar terkait juga ikut terhapus. Jika ragu, gunakan status **Inactive** saja.

## 9. Kebiasaan baik saat bekerja

- **Periksa hasilnya di website** setiap kali selesai menyimpan.
- **Jangan mengedit data yang sama bersamaan** dengan rekan lain. Perubahan yang disimpan terakhir akan menimpa perubahan sebelumnya.
- **Jangan membuka satu formulir di dua tab browser.** Isilah dari satu tab saja.
- **Simpan bahan asli** (foto resolusi penuh, naskah berita) di folder kantor atau Google Drive sebagai cadangan.
- **Gunakan bahasa resmi** dan periksa ejaan nama orang, jabatan, dan lembaga sebelum menerbitkan.
