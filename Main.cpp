#include "Film.cpp"

using namespace std;

// Deklarasi array statis dan counter sebagai pengganti vector
const int MAX_FILM = 100;
Film* daftarFilm[MAX_FILM];
int jumlahFilm = 0;

// Fungsi untuk memeriksa apakah ID sudah ada
bool isIdExists(int id_film) {
    bool ada = false; // flag
    int i = 0; // index
    while (i < jumlahFilm && !ada) { // looping berdasarkan jumlah film saat ini, berhenti jika sudah ketemu
        if (daftarFilm[i]->getId() == id_film) { // jika id nya terdapat kesamaan
            ada = true; // id sudah ada
        }
        i++; // lanjut ke elemen berikutnya
    }
    return ada; // true jika id sudah ada, false jika tidak ditemukan id yang sama
}

// prosedur untuk menampilkan menu yang bisa diakses
void tampilkanMenu() {
    cout << "\n======== W3LC0M3 T0 H0L0 C1N3M4 ========\n";
    cout << "1. Tambah Data Film\n";
    cout << "2. Tampilkan Semua Data Film\n";
    cout << "3. Update Data Film\n";
    cout << "4. Hapus Data Film\n";
    cout << "5. Cari Data Film\n";
    cout << "6. Keluar\n";
}

// prosedur untuk menambah data
void tambahData() {
    if (jumlahFilm >= MAX_FILM) {
        cout << "\nKapasitas penyimpanan penuh. Tidak dapat menambah data.\n";
        return;
    }

    cout << "\n--- Tambahkan Data Film ---\n";
    string inputStr;
    int id_film = 0;
    bool idValid = false; // flag validasi ID
    
    // Validasi ID unik dan integer
    while (!idValid) {
        try {
            cout << "ID Film: ";
            getline(cin, inputStr);
            id_film = stoi(inputStr); // konversi input ke integer
            
            if (!isIdExists(id_film)) { // jika id unik
                idValid = true;
            } else {
                cout << "ID ini sudah ada. Silakan masukkan ID lain.\n";
            }
        } catch (const invalid_argument&) {
            cout << "Input tidak valid. Masukkan angka.\n";
        }
    }
    
    string judul, genre;
    cout << "Judul Film: ";
    getline(cin, judul);
    
    cout << "Genre Film: ";
    getline(cin, genre);

    int durasi = 0;
    bool durasiValid = false; // flag validasi durasi
    // Validasi input numerik untuk durasi
    while (!durasiValid) {
        try {
            cout << "Durasi (menit): ";
            getline(cin, inputStr);
            durasi = stoi(inputStr);
            if (durasi < 0) { // jika input negatif
                cout << "Input tidak valid. Durasi tidak boleh negatif.\n";
            } else {
                durasiValid = true;
            }
        } catch (const invalid_argument&) {
            cout << "Input tidak valid. Masukkan angka.\n";
        }
    }

    int harga = 0;
    bool hargaValid = false; // flag validasi harga
    // Validasi input numerik untuk harga
    while (!hargaValid) {
        try {
            cout << "Harga Tiket (Rp): ";
            getline(cin, inputStr);
            harga = stoi(inputStr);
            if (harga <= 0) { // jika input tidak valid
                cout << "Input tidak valid. Harga harus lebih dari 0.\n";
            } else {
                hargaValid = true;
            }
        } catch (const invalid_argument&) {
            cout << "Input tidak valid. Masukkan angka.\n";
        }
    }

    // Tambahkan objek Film ke dalam array menggunakan pointer
    daftarFilm[jumlahFilm] = new Film(id_film, judul, genre, durasi, harga);
    jumlahFilm++; // tambah counter
    cout << "\nData film berhasil ditambahkan\n";
}

// prosedur untuk menampilkan data
void tampilkanData() {
    cout << "\n--- Daftar Film ---\n";
    if (jumlahFilm == 0) { // jika array kosong
        cout << "\nData film kosong\n";
    } else {
        // looping untuk menampilkan data
        for (int i = 0; i < jumlahFilm; i++) {
            daftarFilm[i]->tampilkanData(); // menampilkan data
            cout << "\n";
        }
    }
}

// prosedur untuk memperbarui data
void updateData() {
    cout << "\n--- Update Data Film ---\n";
    string inputStr;
    int id_update;
    
    try {
        cout << "Masukkan ID Film yang akan diupdate: ";
        getline(cin, inputStr);
        id_update = stoi(inputStr);
    } catch (const invalid_argument&) {
        cout << "Input ID tidak valid. Harus berupa angka.\n";
        return;
    }
    
    bool found = false; // flag
    int i = 0; // index
    // looping untuk semua data didalam array, berhenti jika sudah ketemu
    while (i < jumlahFilm && !found) {
        if (daftarFilm[i]->getId() == id_update) { // jika id yang dicari cocok
            found = true;
            
            // update ID film
            cout << "ID Film baru (" << daftarFilm[i]->getId() << "): ";
            getline(cin, inputStr);
            if (!inputStr.empty()) {
                try {
                    int id_baru = stoi(inputStr);
                    if (id_baru != daftarFilm[i]->getId() && isIdExists(id_baru)) {
                        cout << "ID ini sudah ada. Data tidak diubah.\n";
                    } else {
                        daftarFilm[i]->setId(id_baru);
                    }
                } catch (const invalid_argument&) {
                    cout << "Input ID tidak valid. Data tidak diubah.\n";
                }
            }

            // update judul film
            cout << "Judul Film baru (" << daftarFilm[i]->getJudul() << "): ";
            getline(cin, inputStr);
            if (!inputStr.empty()) {
                daftarFilm[i]->setJudul(inputStr);
            }
            
            // update genre film
            cout << "Genre baru (" << daftarFilm[i]->getGenre() << "): ";
            getline(cin, inputStr);
            if (!inputStr.empty()) {
                daftarFilm[i]->setGenre(inputStr);
            }

            // update durasi film
            cout << "Durasi baru (" << daftarFilm[i]->getDurasi() << "): ";
            getline(cin, inputStr);
            if (!inputStr.empty()) {
                try {
                    int durasi_baru = stoi(inputStr);
                    if (durasi_baru < 0) {
                        cout << "Input durasi tidak valid. Durasi tidak boleh negatif.\n";
                    } else {
                        daftarFilm[i]->setDurasi(durasi_baru);
                    }
                } catch (const invalid_argument&) {
                    cout << "Input durasi tidak valid. Data tidak diubah.\n";
                }
            }

            // update harga tiket
            cout << "Harga baru (" << daftarFilm[i]->getHarga() << "): ";
            getline(cin, inputStr);
            if (!inputStr.empty()) {
                try {
                    int harga_baru = stoi(inputStr);
                    if (harga_baru <= 0) {
                        cout << "Input harga tidak valid. Harga harus lebih dari 0.\n";
                    } else {
                        daftarFilm[i]->setHarga(harga_baru);
                    }
                } catch (const invalid_argument&) {
                    cout << "Input harga tidak valid. Data tidak diubah.\n";
                }
            }

            cout << "\nData film berhasil diupdate\n";
        }
        i++; // lanjut ke elemen berikutnya
    }
    // jika tidak ditemukan id tujuan
    if (!found) {
        cout << "Film dengan ID " << id_update << " tidak ditemukan\n";
    }
}

// prosedur untuk menghapus data
void hapusData() {
    cout << "\n--- Hapus Data Film ---\n";
    string inputStr;
    int id_hapus;
    
    try {
        cout << "Masukkan ID Film yang akan dihapus: ";
        getline(cin, inputStr);
        id_hapus = stoi(inputStr);
    } catch (const invalid_argument&) {
        cout << "Input ID tidak valid. Harus berupa angka.\n";
        return;
    }

    bool found = false; // flag
    int i = 0; // index
    // looping untuk semua elemen dalam array, berhenti jika sudah ketemu
    while (i < jumlahFilm && !found) {
        if (daftarFilm[i]->getId() == id_hapus) { // jika id ditemukan
            found = true;
            delete daftarFilm[i]; // hapus objek dari memori
            
            // geser elemen array ke kiri untuk menutup celah
            for (int j = i; j < jumlahFilm - 1; j++) {
                daftarFilm[j] = daftarFilm[j + 1];
            }
            
            jumlahFilm--; // kurangi counter
            cout << "\nData film berhasil dihapus\n";
        }
        i++; // lanjut ke elemen berikutnya
    }
    if (!found) {
        cout << "Film dengan ID " << id_hapus << " tidak ditemukan\n";
    }
}

// prosedur untuk mencari data
void cariData() {
    cout << "\n--- Cari Data Film ---\n";
    string inputStr;
    int id_cari;
    
    try {
        cout << "Masukkan ID Film yang akan dicari: ";
        getline(cin, inputStr);
        id_cari = stoi(inputStr);
    } catch (const invalid_argument&) {
        cout << "Input ID tidak valid. Harus berupa angka.\n";
        return;
    }

    bool found = false; // flag
    int i = 0; // index
    // looping untuk semua elemen dalam array, berhenti jika sudah ketemu
    while (i < jumlahFilm && !found) {
        if (daftarFilm[i]->getId() == id_cari) { // jika id ditemukan
            found = true;
            cout << "\nData film ditemukan:\n";
            daftarFilm[i]->tampilkanData(); // menampilkan data
        }
        i++; // lanjut ke elemen berikutnya
    }
    if (!found) {
        cout << "Film dengan ID " << id_cari << " tidak ditemukan\n";
    }
}

int main() {
    string pilihan = "";
    
    while (pilihan != "6") { // berhenti jika user memilih 6 (Keluar)
        tampilkanMenu(); // menampilkan menu
        cout << "Pilihan: ";
        getline(cin, pilihan); // input opsi

        if (pilihan == "1") {
            tambahData();
        } else if (pilihan == "2") {
            tampilkanData();
        } else if (pilihan == "3") {
            updateData();
        } else if (pilihan == "4") {
            hapusData();
        } else if (pilihan == "5") {
            cariData();
        } else if (pilihan == "6") {
            cout << "Terima kasih telah menggunakan program ini\n";
            // Membersihkan sisa memori sebelum keluar
            for (int i = 0; i < jumlahFilm; i++) {
                delete daftarFilm[i];
            }
        } else {
            cout << "Pilihan tidak valid. Coba lagi\n";
        }
    }
    return 0;
}