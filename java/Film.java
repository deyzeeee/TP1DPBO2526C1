// deklarasi class Film
public class Film {
    // private atribut
    private int id_film;
    private String judul;
    private String genre;
    private int durasi;  // dalam menit
    private int harga;   // harga tiket dalam rupiah

    // Constructor
    public Film(int id_film_baru, String judul_baru, String genre_baru, int durasi_baru, int harga_baru) {
        this.id_film = id_film_baru; // inisialisasi
        this.judul = judul_baru;     // inisialisasi
        this.genre = genre_baru;     // inisialisasi
        this.durasi = durasi_baru;   // inisialisasi
        this.harga = harga_baru;     // inisialisasi
    }

    // Getter (untuk mendapatkan nilai atribut)
    public int getId() {
        return id_film; // mengembalikan nilai atribut
    }

    public String getJudul() {
        return judul; // mengembalikan nilai atribut
    }

    public String getGenre() {
        return genre; // mengembalikan nilai atribut
    }

    public int getDurasi() {
        return durasi; // mengembalikan nilai atribut
    }

    public int getHarga() {
        return harga; // mengembalikan nilai atribut
    }

    // Setter (untuk mengubah nilai atribut)
    public void setId(int id_film) {
        this.id_film = id_film; // menginisialisasi atribut dengan value baru
    }

    public void setJudul(String judul) {
        this.judul = judul; // menginisialisasi atribut dengan value baru
    }

    public void setGenre(String genre) {
        this.genre = genre; // menginisialisasi atribut dengan value baru
    }

    public void setDurasi(int durasi) {
        if (durasi >= 0) { // durasi harus lebih dari atau sama dengan 0
            this.durasi = durasi; // menginisialisasi atribut dengan value baru
        } else {
            // pesan jika durasi negatif
            System.out.println("Durasi tidak boleh negatif.");
        }
    }

    public void setHarga(int harga) {
        if (harga > 0) { // harga harus lebih dari 0
            this.harga = harga; // menginisialisasi atribut dengan value baru
        } else {
            // pesan jika harga tidak valid
            System.out.println("Harga harus lebih dari 0.");
        }
    }

    // prosedur untuk menampilkan data
    public void tampilkanData() {
        // print data
        System.out.println("ID Film : " + getId());
        System.out.println("Judul : " + getJudul());
        System.out.println("Genre : " + getGenre());
        System.out.println("Durasi : " + getDurasi() + " menit");
        System.out.println("Harga Tiket : Rp. " + getHarga());
    }
}