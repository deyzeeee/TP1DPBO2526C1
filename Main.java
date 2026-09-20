import java.util.Scanner;
import java.util.ArrayList;

public class Main {
    // arraylist untuk menyimpan daftar film
    private static ArrayList<Film> daftarFilm = new ArrayList<>();
    // scanner untuk input dari user
    private static Scanner scanner = new Scanner(System.in);

    // fungsi untuk menentukan id unik
    private static boolean isIdExists(int id_film) {
        boolean ada = false; // flag
        int i = 0; // index
        while (i < daftarFilm.size() && !ada) { // looping ke semua elemen, berhenti jika sudah ketemu
            if (daftarFilm.get(i).getId() == id_film) { // jika elemen ada yang sama
                ada = true; // id sudah ada
            }
            i++; // lanjut ke elemen berikutnya
        }
        return ada; // true jika id sudah ada, false jika elemen itu unik
    }

    // prosedur menampilkan menu
    private static void tampilkanMenu() {
        // print menu
        System.out.println("\n======== W3LC0M3 T0 H0L0 C1N3M4 ========");
        System.out.println("1. Tambah Data Film");
        System.out.println("2. Tampilkan Semua Data Film");
        System.out.println("3. Update Data Film");
        System.out.println("4. Hapus Data Film");
        System.out.println("5. Cari Data Film");
        System.out.println("6. Keluar");
    }

    // prosedur menambahkan data
    private static void tambahData() {
        System.out.println("\n--- Tambahkan Data Film ---");
        int id_film = 0;
        boolean idValid = false; // flag validasi ID
        // Validasi ID unik dan integer
        while (!idValid) {
            try {
                System.out.print("ID Film: ");
                id_film = Integer.parseInt(scanner.nextLine()); // input
                if (!isIdExists(id_film)) { // jika id unik
                    idValid = true;
                } else {
                    System.out.println("ID ini sudah ada. Silakan masukkan ID lain."); // jika id tidak unik
                }
            } catch (NumberFormatException e) {
                System.out.println("Input tidak valid. Masukkan angka.");
            }
        }
        
        System.out.print("Judul Film: ");
        String judul = scanner.nextLine(); // input
        
        System.out.print("Genre Film: ");
        String genre = scanner.nextLine(); // input

        int durasi = 0;
        boolean durasiValid = false; // flag validasi durasi
        // Validasi input numerik untuk durasi
        while (!durasiValid) {
            try {
                System.out.print("Durasi (menit): ");
                durasi = Integer.parseInt(scanner.nextLine());
                if (durasi < 0) { // jika input negatif
                    System.out.println("Input tidak valid. Durasi tidak boleh negatif.");
                } else {
                    durasiValid = true;
                }
            } catch (NumberFormatException e) { // jika input bukan angka
                System.out.println("Input tidak valid. Masukkan angka.");
            }
        }

        int harga = 0;
        boolean hargaValid = false; // flag validasi harga
        // Validasi input numerik untuk harga
        while (!hargaValid) {
            try {
                System.out.print("Harga Tiket (Rp): ");
                harga = Integer.parseInt(scanner.nextLine());
                if (harga <= 0) { // jika input kurang dari atau sama dengan nol
                    System.out.println("Input tidak valid. Harga harus lebih dari 0.");
                } else {
                    hargaValid = true;
                }
            } catch (NumberFormatException e) { // jika input bukan angka
                System.out.println("Input tidak valid. Masukkan angka.");
            }
        }

        Film film_baru = new Film(id_film, judul, genre, durasi, harga);
        daftarFilm.add(film_baru); // memasukkan objek ke dalam array
        System.out.println("\nData film berhasil ditambahkan");
    }

    // prosedur menampilkan data
    private static void tampilkanData() {
        System.out.println("\n--- Daftar Film ---");
        if (daftarFilm.isEmpty()) { // jika daftar film kosong
            System.out.println("\nData film kosong");
        } else {
            // jika daftar film ada
            for (Film film : daftarFilm) { // looping ke semua elemen array
                film.tampilkanData(); // menampilkan data
                System.out.println(); // newline
            }
        }
    }

    // prosedur untuk memperbarui data
    private static void updateData() {
        System.out.println("\n--- Update Data Film ---");
        int id_update;
        try {
             System.out.print("Masukkan ID Film yang akan diupdate: ");
             id_update = Integer.parseInt(scanner.nextLine()); // input
        } catch (NumberFormatException e) {
             System.out.println("Input ID tidak valid. Harus berupa angka.");
             return;
        }
        
        boolean found = false; // flag
        int i = 0; // index
        while (i < daftarFilm.size() && !found) { // looping ke semua elemen film, berhenti jika sudah ketemu
            Film film = daftarFilm.get(i);
            if (film.getId() == id_update) { // jika film ditemukan
                found = true;

                // update ID film
                System.out.print("ID Film baru (" + film.getId() + "): ");
                String id_baru = scanner.nextLine(); // input
                if (!id_baru.isEmpty()) { // jika input tidak kosong
                    try {
                        int id_baru_int = Integer.parseInt(id_baru);
                        // Cek apakah ID baru berbeda dengan ID lama, dan apakah ID baru sudah ada di daftar
                        if (id_baru_int != film.getId() && isIdExists(id_baru_int)) {
                            System.out.println("ID ini sudah ada. Data tidak diubah.");
                        } else {
                            film.setId(id_baru_int); // memasukkan value
                        }
                    } catch (NumberFormatException e) { // jika input bukan angka
                        System.out.println("Input ID tidak valid. Data tidak diubah.");
                    }
                }

                // update judul film
                System.out.print("Judul Film baru (" + film.getJudul() + "): ");
                String judul_baru = scanner.nextLine(); // input
                if (!judul_baru.isEmpty()) {
                    film.setJudul(judul_baru);
                }
                
                // update genre film
                System.out.print("Genre baru (" + film.getGenre() + "): ");
                String genre_baru = scanner.nextLine(); // input
                if (!genre_baru.isEmpty()) {
                    film.setGenre(genre_baru);
                }

                // update durasi film
                System.out.print("Durasi baru (" + film.getDurasi() + "): ");
                String durasi_baru = scanner.nextLine(); // input
                if (!durasi_baru.isEmpty()) {
                    try {
                        int durasi_baru_int = Integer.parseInt(durasi_baru);
                        if (durasi_baru_int < 0) { // jika input negatif
                            System.out.println("Input durasi tidak valid. Durasi tidak boleh negatif.");
                        } else {
                            film.setDurasi(durasi_baru_int); // memasukkan value
                        }
                    } catch (NumberFormatException e) { // jika input bukan angka
                        System.out.println("Input durasi tidak valid. Data tidak diubah.");
                    }
                }

                // update harga tiket
                System.out.print("Harga baru (" + film.getHarga() + "): ");
                String harga_baru = scanner.nextLine(); // input
                if (!harga_baru.isEmpty()) {
                    try {
                        int harga_baru_int = Integer.parseInt(harga_baru);
                        if (harga_baru_int <= 0) {
                            System.out.println("Input harga tidak valid. Harga harus lebih dari 0.");
                        } else {
                            film.setHarga(harga_baru_int); // memasukkan value
                        }
                    } catch (NumberFormatException e) { // jika input tidak valid
                        System.out.println("Input harga tidak valid. Data tidak diubah.");
                    }
                }

                System.out.println("\nData film berhasil diupdate");
            }
            i++; // lanjut ke elemen berikutnya
        }

        if (!found) { // jika id tidak ditemukan
            System.out.println("Film dengan ID " + id_update + " tidak ditemukan");
        }
    }

    // prosedur menghapus data
    private static void hapusData() {
        System.out.println("\n--- Hapus Data Film ---");
        int id_hapus;
        try {
             System.out.print("Masukkan ID Film yang akan dihapus: ");
             id_hapus = Integer.parseInt(scanner.nextLine()); // input
        } catch (NumberFormatException e) {
             System.out.println("Input ID tidak valid. Harus berupa angka.");
             return;
        }

        boolean found = false; // flag
        int i = 0; // index
        while (i < daftarFilm.size() && !found) { // looping ke semua elemen, berhenti jika sudah ketemu
            if (daftarFilm.get(i).getId() == id_hapus) { // jika ditemukan id yang dicari
                daftarFilm.remove(i); // hapus data
                found = true; // flag true
                System.out.println("\nData film berhasil dihapus");
            }
            i++; // lanjut ke elemen berikutnya
        }

        if (!found) { // jika tidak ditemukan
            System.out.println("Film dengan ID " + id_hapus + " tidak ditemukan");
        }
    }

    // prosedur mencari data
    private static void cariData() {
        System.out.println("\n--- Cari Data Film ---");
        int id_cari;
        try {
             System.out.print("Masukkan ID Film yang akan dicari: ");
             id_cari = Integer.parseInt(scanner.nextLine()); // input
        } catch (NumberFormatException e) {
             System.out.println("Input ID tidak valid. Harus berupa angka.");
             return;
        }

        boolean found = false; // flag
        int i = 0; // index
        while (i < daftarFilm.size() && !found) { // looping ke semua elemen, berhenti jika sudah ketemu
            Film film = daftarFilm.get(i);
            if (film.getId() == id_cari) { // jika ditemukan id yang dicari
                System.out.println("\nData film ditemukan:");
                film.tampilkanData(); // menampilkan data
                found = true;
            }
            i++; // lanjut ke elemen berikutnya
        }

        if (!found) { // jika tidak ditemukan
            System.out.println("Film dengan ID " + id_cari + " tidak ditemukan");
        }
    }

    // main program
    public static void main(String[] args) {
        String pilihan = "";
        while (!pilihan.equals("6")) { // berhenti jika user memilih 6 (Keluar)
            tampilkanMenu(); // menampilkan menu
            System.out.print("Pilihan: ");
            pilihan = scanner.nextLine(); // input opsi

            if (pilihan.equals("1")) { // opsi 1
                tambahData(); // menambah data
            } else if (pilihan.equals("2")) { // opsi 2
                tampilkanData(); // menampilkan data
            } else if (pilihan.equals("3")) { // opsi 3
                updateData(); // memperbarui data
            } else if (pilihan.equals("4")) { // opsi 4
                hapusData(); // menghapus data
            } else if (pilihan.equals("5")) { // opsi 5
                cariData(); // mencari data
            } else if (pilihan.equals("6")) { // opsi 6
                System.out.println("Terima kasih telah menggunakan program ini");
            } else {
                System.out.println("Pilihan tidak valid. Coba lagi");
            }
        }
    }
}