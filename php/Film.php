<?php
    class Film {
        // private atribut
        private int $id_film;
        private string $judul;
        private string $genre;
        private int $durasi;
        private int $harga;
        private string $poster;

        // constructor
        public function __construct(int $id_film, string $judul, string $genre, int $durasi, int $harga, string $poster)
        {
            $this->id_film = $id_film; // inisialisasi atribut
            $this->judul = $judul; // inisialisasi atribut
            $this->genre = $genre; // inisialisasi atribut
            $this->durasi = $durasi; // inisialisasi atribut
            $this->harga = $harga; // inisialisasi atribut
            $this->poster = $poster; // inisialisasi atribut
        }

        // Getter (untuk mendapatkan nilai atribut)
        public function getId(): int
        {
            return $this->id_film; // mengembalikan nilai atribut
        }

        public function getJudul(): string
        {
            return $this->judul; // mengembalikan nilai atribut
        }

        public function getGenre(): string
        {
            return $this->genre; // mengembalikan nilai atribut
        }

        public function getDurasi(): int
        {
            return $this->durasi; // mengembalikan nilai atribut
        }

        public function getHarga(): int
        {
            return $this->harga; // mengembalikan nilai atribut
        }

        public function getPoster(): string
        {
            return $this->poster; // mengembalikan nilai atribut
        }

        // Setter (untuk mengubah nilai atribut)
        public function setId(int $id_film): void
        {
            $this->id_film = $id_film; // menginisialisasi atribut dengan value baru
        }

        public function setJudul(string $judul): void
        {
            $this->judul = $judul; // menginisialisasi atribut dengan value baru
        }

        public function setGenre(string $genre): void
        {
            $this->genre = $genre; // menginisialisasi atribut dengan value baru
        }

        public function setDurasi(int $durasi): void
        {
            // Validasi: memastikan durasi tidak negatif
            if ($durasi >= 0) {
                $this->durasi = $durasi; // menginisialisasi atribut dengan value baru
            } else {
                echo "Durasi tidak boleh negatif."; // jika input tidak valid
            }
        }

        public function setHarga(int $harga): void
        {
            // Validasi: memastikan harga lebih dari 0
            if ($harga > 0) {
                $this->harga = $harga; // menginisialisasi atribut dengan value baru
            } else {
                echo "Harga harus lebih dari 0."; // jika input tidak valid
            }
        }

        public function setPoster(string $poster): void
        {
            $this->poster = $poster; // menginisialisasi atribut dengan value baru
        }

        // function untuk menampilkan data (Opsional untuk testing tanpa UI)
        public function tampilkanData(): void
        {
            // print
            echo "ID Film: " . $this->getId() . "<br>";
            echo "Judul: " . $this->getJudul() . "<br>";
            echo "Genre: " . $this->getGenre() . "<br>";
            echo "Durasi: " . $this->getDurasi() . " menit<br>";
            echo "Harga: Rp " . $this->getHarga() . "<br>";
            echo "Poster: " . $this->getPoster() . "<br>";
        }
    }
?>