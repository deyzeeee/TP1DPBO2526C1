# JANJI
Saya Muhammad Fadey Rafif dengan NIM 2504792 mengerjakan Tugas Praktikum 1 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# STRUKTUR FILE
```
TP1DPBO2627C1/
├── c++/
│   ├── Film.cpp
│   └── Main.cpp
│
├── java/
│   ├── Film.java
│   └── Main.java
│
├── python/
│   ├── Film.py
│   └── Main.py
│
├── php/
│   ├── Film.php
│   ├── Main.php
│   └── images/
│       └── *.jpg
│
├── dokumentasi TP1/
│   ├── cpp/
│   │   └── *.png
│   │
│   ├── java/
│   │   └── *.png
│   │
│   ├── python/
│   │   └── *.png
│   │
│   └── php/
│       └── *.png
│
└── Readme.md
```

# 🎬 TEMA PROGRAM
Manajemen Bioskop Holo Cinema: program untuk mengelola data film yang sedang tayang. Setiap film adalah objek dari class `Film`, seluruh objek disimpan dalam list (tanpa database). Program dibuat dalam 4 bahasa: C++, Java, Python dan PHP.

# FITUR UTAMA
- Tambah Data: Menambah objek film baru.
- Tampilkan Data: Menampilkan semua film yang tersimpan.
- Update Data: Mengubah data film berdasarkan ID unik.
- Hapus Data: Menghapus film berdasarkan ID unik.
- Cari Data: Mencari satu film berdasarkan ID.
- Reset Data (khusus PHP): Menghapus seluruh data film sekaligus.

# DESAIN PROGRAM
Program terdiri dari __1__ class, yaitu __Film__ yang terdiri dari atribut berikut:
- Id_film
- judul
- genre
- durasi
- harga
- Images/poster (khusus PHP)

----------------------------------------------------------------------------------------------------------
| Atribut   | Tipe   | Alasan                                                                            |
| --------- | ------ | --------------------------------------------------------------------------------- |
| `id_film` | int    | Identifier unik, dipakai untuk update, hapus, dan cari. Dicek agar tidak duplikat |
| `judul`   | string | Nama film                                                                         |
| `genre`   | string | Kategori film                                                                     |
| `durasi`  | int    | Durasi dalam menit. Divalidasi di setter: tidak boleh negatif                     |
| `harga`   | int    | Harga tiket dalam rupiah. Divalidasi di setter: harus lebih dari 0                |
| `poster`  | string | Khusus PHP: path file gambar lokal di folder `images/`                            |
----------------------------------------------------------------------------------------------------------

# 🔁 ALUR KODE
Semua versi memakai menu yang sama (versi web memakai form dan tombol dengan alur yang setara).
1. Tambah: input ID (harus angka dan unik) → judul → genre → durasi → harga → objek `Film` dibuat lalu dimasukkan ke list.
2. Tampilkan: list dilooping dan tiap objek memanggil `tampilkanData()`. Jika kosong tampil "Data film kosong".
3. Update: input ID yang dicari → nilai lama ditampilkan di dalam kurung → isi nilai baru atau enter untuk mempertahankan nilai lama. ID baru dicek agar tidak bentrok dengan film lain.
4. Hapus: cari objek dengan ID yang sama di list lalu dihapus.
5. Cari: cari objek dengan ID yang sama lalu tampilkan datanya.
6. Keluar: program berhenti.

# 🛑 Error Handling di semua program
- Terdapat pesan error jika input ID, durasi, atau harga berisi non numeric. Saat tambah data program meminta input kembali, saat update data lama tidak diubah.
- Terdapat pesan error jika durasi bernilai negatif atau harga kurang dari sama dengan 0.
- Terdapat pesan error jika menambah data dengan ID yang tidak unik.
- Terdapat pesan error jika saat update, ID baru sudah dipakai film lain. Data ID tidak diubah.
- Terdapat pesan "Film dengan ID ... tidak ditemukan" jika ID yang diupdate, dihapus, atau dicari tidak ada.

# DOKUMENTASI OUTPUT
Program dapat menambahkan, menampilkan, mengubah, menghapus dan mencari data film.

## Output program C++
### Menambahkan data (beserta error handling input)
<img src="dokumentasi%20TP1/cpp/tambah%20data%20film%20dan%20error%20handling%20cpp.png" alt="tambah data film dan error handling cpp">
<br>

### Menampilkan semua data
<img src="dokumentasi%20TP1/cpp/tampil%20data%20film%20cpp.png" alt="tampil data film cpp">
<br>

### Memperbarui data
Jika kita tidak ingin memperbarui atribut, bisa langsung enter saja dan akan menyimpan nilai lama. Jika kita ingin merubah atribut, bisa menginput nilai baru.

Update berhasil dan error handling format penulisan harga: <br>
<img src="dokumentasi%20TP1/cpp/update%20berhasil%20dan%20error%20handling%20format%20penulisan%20harga%20cpp.png" alt="update berhasil dan error handling format penulisan harga cpp">
<br>

Update dengan ID yang tidak ditemukan: <br>
<img src="dokumentasi%20TP1/cpp/update%20data%20id%20salah%20cpp.png" alt="update data id salah cpp">
<br>

Hasil: <br>
<img src="dokumentasi%20TP1/cpp/tampil%20film%20setelah%20update%20cpp.png" alt="tampil film setelah update cpp">
<br>

### Mencari data
Data ditemukan: <br>
<img src="dokumentasi%20TP1/cpp/cari%20data%20film%20berhasil%20cpp.png" alt="cari data film berhasil cpp">
<br>

ID tidak ditemukan: <br>
<img src="dokumentasi%20TP1/cpp/cari%20data%20film%20id%20salah%20cpp.png" alt="cari data film id salah cpp">
<br>

### Menghapus data
ID tidak ditemukan: <br>
<img src="dokumentasi%20TP1/cpp/hapus%20film%20id%20salah%20cpp.png" alt="hapus film id salah cpp">
<br>

Hasil (berhasil dihapus dan ditampilkan kembali): <br>
<img src="dokumentasi%20TP1/cpp/hapus%20film%20berhasil%20dan%20tampil%20film%20cpp.png" alt="hapus film berhasil dan tampil film cpp">
<br>

## Output program Java (JAWA)
### Menambahkan data
<img src="dokumentasi%20TP1/java/tambah%20film%20berhasil%20java.png" alt="tambah film berhasil java">
<br>

### Menampilkan semua data
<img src="dokumentasi%20TP1/java/daftar%20film%20java.png" alt="daftar film java">
<br>

### Memperbarui data
Jika kita tidak ingin memperbarui atribut, bisa langsung enter saja dan akan menyimpan nilai lama. Jika kita ingin merubah atribut, bisa menginput nilai baru.

Update berhasil: <br>
<img src="dokumentasi%20TP1/java/update%20film%20berhasil%20java.png" alt="update film berhasil java">
<br>

Hasil: <br>
<img src="dokumentasi%20TP1/java/tampil%20hasil%20update%20film%20java.png" alt="tampil hasil update film java">
<br>

Error jika durasi tidak valid: <br>
<img src="dokumentasi%20TP1/java/update%20film%20durasi%20tidak%20valid%20java.png" alt="update film durasi tidak valid java">
<br>

Error jika ID film tidak ditemukan: <br>
<img src="dokumentasi%20TP1/java/update%20film%20id%20film%20salah%20java.png" alt="update film id film salah java">
<br>

### Mencari data
Data ditemukan: <br>
<img src="dokumentasi%20TP1/java/cari%20data%20film%20ditemukan%20java.png" alt="cari data film ditemukan java">
<br>

ID tidak ditemukan: <br>
<img src="dokumentasi%20TP1/java/cari%20id%20film%20tidak%20ditemukan%20java.png" alt="cari id film tidak ditemukan java">
<br>

### Menghapus data
ID tidak ditemukan: <br>
<img src="dokumentasi%20TP1/java/hapus%20data%20film%20id%20salah%20java.png" alt="hapus data film id salah java">
<br>

Hasil (berhasil dihapus dan ditampilkan kembali): <br>
<img src="dokumentasi%20TP1/java/hapus%20data%20film%20berhasil%20dan%20ditampilkan%20java.png" alt="hapus data film berhasil dan ditampilkan java">
<br>

## Output program Python
### Menambahkan data (beserta error handling input)
<img src="dokumentasi%20TP1/python/Input%20data%20dan%20error%20handling%20nya%20py.png" alt="Input data dan error handling nya py">
<br>

### Menampilkan semua data
<img src="dokumentasi%20TP1/python/tampil%20film%20py.png" alt="tampil film py">
<br>

### Memperbarui data
Jika kita tidak ingin memperbarui atribut, bisa langsung enter saja dan akan menyimpan nilai lama. Jika kita ingin merubah atribut, bisa menginput nilai baru.

Update berhasil: <br>
<img src="dokumentasi%20TP1/python/update%20data%20berhasil%20py.png" alt="update data berhasil py">
<br>

Hasil (ID film diubah menjadi 102): <br>
<img src="dokumentasi%20TP1/python/hasil%20update%20id%20film%20102%20py.png" alt="hasil update id film 102 py">
<br>

Error jika durasi tidak valid: <br>
<img src="dokumentasi%20TP1/python/error%20handling%20update%20durasi%20py.png" alt="error handling update durasi py">
<br>

Error jika ID tidak ditemukan: <br>
<img src="dokumentasi%20TP1/python/error%20handling%20update%20salah%20id%20py.png" alt="error handling update salah id py">
<br>

### Mencari data
Data ditemukan: <br>
<img src="dokumentasi%20TP1/python/cari%20data%20berhasil%20py.png" alt="cari data berhasil py">
<br>

ID tidak ditemukan: <br>
<img src="dokumentasi%20TP1/python/error%20handling%20cari%20data%20py.png" alt="error handling cari data py">
<br>

### Menghapus data
Berhasil dihapus: <br>
<img src="dokumentasi%20TP1/python/hapus%20id%20berhasil%20py.png" alt="hapus id berhasil py">
<br>

ID tidak ditemukan: <br>
<img src="dokumentasi%20TP1/python/error%20handling%20hapus%20id%20py.png" alt="error handling hapus id py">
<br>

### Tampilan akhir
<img src="dokumentasi%20TP1/python/hasil%20akhir%20py.png" alt="hasil akhir py">
<br>

## Output program PHP
### Error jika input harga/durasi berupa number negatif
Input: <br>
<img src="dokumentasi%20TP1/php/test%20case%20harga%20dan%20durasi%20negatif%20untuk%20tambah%20film.png" alt="test case harga dan durasi negatif untuk tambah film">
<br>

Hasil: <br>
<img src="dokumentasi%20TP1/php/error%20handling%20harga%20dan%20durasi%20film.png" alt="error handling harga dan durasi film">
<br>

### Error jika menambahkan id yang sudah dipakai
Input: <br>
<img src="dokumentasi%20TP1/php/test%20case%20id%20double%20tambah%20film.png" alt="test case id double tambah film">
<br>

Hasil: <br>
<img src="dokumentasi%20TP1/php/error%20handling%20tambah%20film%20id%20double.png" alt="error handling tambah film id double">
<br>

### Menambahkan data
Input: <br>
<img src="dokumentasi%20TP1/php/test%20case%20tambah%20film%20yg%20sesuai.png" alt="test case tambah film yg sesuai">
<br>

Hasil: <br>
<img src="dokumentasi%20TP1/php/hasil%20penambahan%20data%20film.png" alt="hasil penambahan data film">
<br>

### Menampilkan semua data
Data langsung tampil dalam tabel. Jika habis mencari film, pencet tombol "Tampilkan Semua" untuk kembali menampilkan semua film.

<img src="dokumentasi%20TP1/php/hasil%20tombol%20tampil%20film.png" alt="hasil tombol tampil film">
<br>

### Memperbarui data
Ubah hanya kolom yang ingin diperbarui. Poster bersifat opsional, jika tidak upload gambar baru maka poster lama tetap dipakai.

Sebelum update: <br>
<img src="dokumentasi%20TP1/php/sebelum%20update%20film.png" alt="sebelum update film">
<br>

Input (tombol Update pada baris film, form otomatis terisi nilai lama): <br>
<img src="dokumentasi%20TP1/php/test%20case%20update%20film%20yg%20benar.png" alt="test case update film yg benar">
<br>

Hasil (pesan berhasil): <br>
<img src="dokumentasi%20TP1/php/hasil%20update%20data%20film%281%29.png" alt="hasil update data film(1)">
<br>

Hasil (tabel setelah update): <br>
<img src="dokumentasi%20TP1/php/hasil%20update%20data%20film.png" alt="hasil update data film">
<br>

Error jika salah input saat update, input: <br>
<img src="dokumentasi%20TP1/php/test%20case%20salah%20input%20ketika%20updtae%20film.png" alt="test case salah input ketika updtae film">
<br>

Error jika salah input saat update, hasil: <br>
<img src="dokumentasi%20TP1/php/error%20handling%20salah%20input%20ketika%20update%20film.png" alt="error handling salah input ketika update film">
<br>

### Mencari data
Masukkan id yang ingin dicari: <br>
<img src="dokumentasi%20TP1/php/cari%20id%20film.png" alt="cari id film">
<br>

Tampilan: <br>
<img src="dokumentasi%20TP1/php/hasil%20cari%20film%20berdasarkan%20id.png" alt="hasil cari film berdasarkan id">
<br>

### Menghapus data
Tombol Hapus untuk menghapus satu film (muncul konfirmasi): <br>
<img src="dokumentasi%20TP1/php/hapus%201%20film%20%28re%29.png" alt="hapus 1 film (re)">
<br>

Hasil: <br>
<img src="dokumentasi%20TP1/php/after%20hapus%201%20film.png" alt="after hapus 1 film">
<br>

### Reset data
Tombol Reset Data untuk mereset session dan menghapus semua data: <br>
<img src="dokumentasi%20TP1/php/reset_hapus%20semua%20data.png" alt="reset_hapus semua data">
<br>

Hasil: <br>
<img src="dokumentasi%20TP1/php/after%20semua%20data%20di%20reset.png" alt="after semua data di reset">
<br>
