<?php
require_once 'Film.php';
session_start();

// Reset SESSION
if (isset($_POST['reset_data'])) {
    session_unset();
    session_destroy();
    header("Location: Main.php");
    exit(); // biar exit langsung page nya
}

// Inisialisasi session
if (!isset($_SESSION['daftarFilm'])) {
    $_SESSION['daftarFilm'] = []; // array
}

$message = '';
$message_type = '';

// helper cek ID
function isIdExists($id_film, $list) {
    foreach ($list as $item) // looping
    {
        if ($item->getId() === $id_film) // jika id ditemukan / tidak unik
        {
            return true;
        }
    }
    return false; // jika id unik
}

// Tambah film
if (isset($_POST['tambah'])) {
    $id_film = (int) trim($_POST['id_film']); // input
    $judul = trim($_POST['judul']); // input
    $genre = trim($_POST['genre']); // input
    $durasi = $_POST['durasi']; // input
    $harga = $_POST['harga']; // input

    // Validasi input
    if (empty($id_film) || empty($judul) || empty($genre) || !is_numeric($durasi) || !is_numeric($harga) || $durasi < 0 || $harga <= 0) {
        $message = "❌ Input tidak valid. Pastikan form terisi dengan benar.";
        $message_type = 'error';
    } elseif (isIdExists($id_film, $_SESSION['daftarFilm'])) // mengecek id apakah unik atau tidak
    {
        // jika tidak unik
        $message = "❌ ID sudah ada. Gagal menambahkan film.";
        $message_type = 'error';
    } else {
        // jika id valid
        // Upload poster
        $poster = '';
        if (!empty($_FILES['poster']['name']) && $_FILES['poster']['error'] == 0) // jika gambar tidak error
        {
            $target_dir = "./images/"; // target folder
            if (!is_dir($target_dir)) mkdir($target_dir); // cek jika folder belum ada maka buat folder
            $target_file = $target_dir . time() . "_" . basename($_FILES["poster"]["name"]); // inisialisasi nama gambar
            if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) // kirim file
            {
                $poster = $target_file; // inisialisasi file gambar
            }
        }

        $film_baru = new Film($id_film, $judul, $genre, (int)$durasi, (int)$harga, $poster); // buat objek baru untuk dimasukkan ke array
        $_SESSION['daftarFilm'][] = $film_baru; // inisialisasi ke array

        $message = "✅ Data film berhasil ditambahkan!"; // success message
        $message_type = 'success';
    }
}

// Hapus film
if (isset($_GET['action']) && $_GET['action'] === 'hapus' && isset($_GET['id'])) {
    $id_hapus = (int) $_GET['id']; // ambil input id
    $_SESSION['daftarFilm'] = array_values(array_filter($_SESSION['daftarFilm'], fn($p) => $p->getId() !== $id_hapus)); // menyimpan array kecuali id yang ingin dihapus
    $message = "🗑️ Data film berhasil dihapus!"; // message success
    $message_type = 'success';
    header("Location: Main.php"); // balik ke page awal
    exit();
}

// function untuk update film
function updateFilm($id_update) {
    global $message, $message_type;
    foreach ($_SESSION['daftarFilm'] as $film) // looping ke semua elemen
    {
        if ($film->getId() === (int)$id_update) // jika id ditemukan
        {
            $id_baru = trim($_POST['id_baru']);
            $judul_baru = trim($_POST['judul']);
            $genre_baru = trim($_POST['genre']);
            $durasi_baru = $_POST['durasi'];
            $harga_baru = $_POST['harga'];

            // Validasi input
            if (empty($judul_baru) || empty($genre_baru) || !is_numeric($durasi_baru) || !is_numeric($harga_baru) || $durasi_baru < 0 || $harga_baru <= 0) {
                $message = "❌ Input tidak valid. Pastikan form terisi dengan benar.";
                $message_type = 'error';
                return [$message, $message_type];
            }

            // update ID film
            if (!empty($id_baru) && (int)$id_baru !== $film->getId())
            {
                if (isIdExists((int)$id_baru, $_SESSION['daftarFilm'])) // jika input tidak valid
                {
                    // error
                    $message = "⚠️ ID baru sudah digunakan, ID tidak diubah.";
                    $message_type = 'warning';
                } else {
                    $film->setId((int)$id_baru); // jika input valid
                }
            }

            // update judul
            $film->setJudul($judul_baru);
            
            // update genre
            $film->setGenre($genre_baru);

            // update durasi
            $film->setDurasi((int)$durasi_baru);

            // update harga
            $film->setHarga((int)$harga_baru);

            // update poster jika ada upload baru
            if (!empty($_FILES['poster']['name']) && $_FILES['poster']['error'] == 0) {
                $target_dir = "./images/"; // folder yang dituju
                if (!is_dir($target_dir)) mkdir($target_dir); // cek apakah folder sudah ada, jika belum maka buat folder
                $target_file = $target_dir . time() . "_" . basename($_FILES["poster"]["name"]);
                if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file))
                {
                    $film->setPoster($target_file); // update path gambar
                }
            }
            
            // hanya tampilkan pesan sukses kalau tidak ada warning
            if ($message_type !== 'warning') {
                $message = "✏️ Data film berhasil diupdate!";
                $message_type = 'success';
            }

            return [$message, $message_type]; // langsung keluar dari fungsi
        }
    }
    $message = "Film tidak ditemukan.";
    $message_type = 'error';
    return [$message, $message_type]; // kalau tidak ketemu film
}

// eksekusi update
if (isset($_POST['update'])) {
    [$message, $message_type] = updateFilm($_POST['id_film']); // proses update
}

// Cari film
$hasil_cari = $_SESSION['daftarFilm'];
if (isset($_GET['cari'])) // cek apakah null atau tidak
{
    $id_cari = (int) trim($_GET['cari_id']); // input
    $hasil_cari = array_values(array_filter($_SESSION['daftarFilm'], fn($p) => $p->getId() === $id_cari)); // cari id didalam array temp
    if (empty($hasil_cari)) {
        $message = "Film dengan ID '$id_cari' tidak ditemukan.";
        $message_type = 'warning';
    }
}

// Fungsi untuk ambil film berdasarkan ID
function getFilmById($id) {
    foreach ($_SESSION['daftarFilm'] as $film) // looping ke semua elemen
    {
        if ($film->getId() === (int)$id) // jika id film ditemukan
        {
            return $film; // langsung kembalikan objek film
        }
    }
    return null; // kalau tidak ketemu
}

$edit_id = $edit_judul = $edit_genre = $edit_durasi = $edit_harga = $edit_poster = ''; // default
if (isset($_GET['edit_id'])) // jika edit id tidak null
{
    $film = getFilmById($_GET['edit_id']); // cari objek
    if ($film !== null) {
        $edit_id     = $film->getId(); // mengambil value atribut
        $edit_judul  = $film->getJudul(); // mengambil value atribut
        $edit_genre  = $film->getGenre(); // mengambil value atribut
        $edit_durasi = $film->getDurasi(); // mengambil value atribut
        $edit_harga  = $film->getHarga(); // mengambil value atribut
        $edit_poster = $film->getPoster(); // mengambil value atribut
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>WELCOME TO HOLO CINEMA</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
    min-height: 100vh;
    background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.container {
    width: 100%;
    max-width: 1200px;
    background: rgba(255, 255, 255, 0.9);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 2.2rem;
    letter-spacing: 1px;
}

.message {
    padding: 14px;
    margin-bottom: 18px;
    border-radius: 8px;
    font-weight: bold;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.success {
    background: #d4edda;
    color: #155724;
}

.error {
    background: #f8d7da;
    color: #721c24;
}

.warning {
    background: #fff3cd;
    color: #856404;
}

form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: #fdfdfd;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #eee;
}

form input,
form button {
    padding: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: 0.3s ease;
}

form input:focus {
    border-color: #6c5ce7;
    outline: none;
    box-shadow: 0 0 6px rgba(108, 92, 231, 0.3);
}

form button {
    cursor: pointer;
    font-weight: bold;
    border: none;
    transition: transform 0.2s ease, opacity 0.2s ease;
}

form button:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.btn-tambah {
    background: #2ecc71;
    color: white;
}

.btn-update {
    background: #3498db;
    color: white;
}

.btn-reset {
    background: #e74c3c;
    color: white;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

th,
td {
    padding: 14px;
    border: 1px solid #eee;
    text-align: left;
}

thead {
    background: linear-gradient(135deg, #6c5ce7, #0984e3);
    color: white;
}

tbody tr:nth-child(even) {
    background: #f9f9f9;
}

tbody tr:hover {
    background: #f1f7ff;
}

.actions a {
    padding: 7px 12px;
    border-radius: 6px;
    color: white;
    text-decoration: none;
    margin-right: 5px;
    font-size: 13px;
    transition: 0.2s ease;
}

.actions a:hover {
    opacity: 0.85;
}

.edit {
    background: #f39c12;
}

.delete {
    background: #e74c3c;
}

.product-img {
    max-width: 90px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.search-container {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

.search-container form {
    display: flex;
    gap: 10px;
    width: 100%;
    max-width: 500px;
    background: transparent;
    border: none;
    padding: 0;
}

.search-container input {
    flex: 1;
    border-radius: 8px;
}

.search-container button {
    background: #9b59b6;
    color: white;
    border: none;
    border-radius: 8px;
}

.reset-container {
    text-align: center;
    margin-top: 20px;
}

.btn-showall {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 14px;
    background: #7f8c8d;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s;
}

.btn-showall:hover {
    opacity: 0.9;
}
</style>
</head>
<body>
<div class="container">
    <h1>🎬 WELCOME TO HOLO CINEMA</h1>

    <?php if ($message): ?> 
        <div class="message <?= $message_type; ?>"><?= $message; ?></div>
    <?php endif; ?>

    <form action="Main.php" method="POST" enctype="multipart/form-data">
        <h2><?= $edit_id ? '✏️ Update Data Film' : '➕ Tambah Data Film'; ?></h2>
        <?php if ($edit_id): ?>
            <input type="hidden" name="id_film" value="<?= htmlspecialchars($edit_id); ?>"> 
            <input type="number" name="id_baru" value="<?= htmlspecialchars($edit_id); ?>" placeholder="ID Film" required> 
        <?php else: ?>
            <input type="number" name="id_film" placeholder="ID Film" required>
        <?php endif; ?>

        <input type="text" name="judul" value="<?= htmlspecialchars($edit_judul); ?>" placeholder="Judul Film" required>
        <input type="text" name="genre" value="<?= htmlspecialchars($edit_genre); ?>" placeholder="Genre Film" required>
        <input type="number" name="durasi" value="<?= htmlspecialchars($edit_durasi); ?>" placeholder="Durasi (menit)" required>
        <input type="number" name="harga" value="<?= htmlspecialchars($edit_harga); ?>" placeholder="Harga Tiket (Rp)" required>
        <input type="file" name="poster">
        <?php if ($edit_poster): ?>
            <p>📷 <a href="<?= htmlspecialchars($edit_poster); ?>" target="_blank">Lihat Poster</a></p>
        <?php endif; ?>
        <button type="submit" name="<?= $edit_id ? 'update' : 'tambah'; ?>" class="<?= $edit_id ? 'btn-update' : 'btn-tambah'; ?>">
            <?= $edit_id ? 'Update' : 'Tambah'; ?>
        </button>
    </form>

    <div class="search-container">
        <form action="Main.php" method="GET" style="display:flex; gap:10px; width:100%; max-width:500px;">
            <input type="number" name="cari_id" placeholder="Cari berdasarkan ID Film" required>
            <button type="submit" name="cari">Cari</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Film</th>
                <th>Judul</th>
                <th>Genre</th>
                <th>Durasi (menit)</th>
                <th>Harga Tiket</th>
                <th>Poster</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($hasil_cari)): ?>
                <tr><td colspan="7" style="text-align:center;">🚫 Tidak ada data film.</td></tr>
            <?php else: ?>
                <?php foreach ($hasil_cari as $film): ?>
                    <tr>
                        <td><?= htmlspecialchars($film->getId()); ?></td>
                        <td><?= htmlspecialchars($film->getJudul()); ?></td>
                        <td><?= htmlspecialchars($film->getGenre()); ?></td>
                        <td><?= htmlspecialchars($film->getDurasi()); ?></td>
                        <td><?= 'Rp ' . number_format($film->getHarga(), 0, ',', '.'); ?></td>
                        <td>
                            <?php if ($film->getPoster()): ?>
                                <img src="<?= htmlspecialchars($film->getPoster()); ?>" class="product-img">
                            <?php else: ?>
                                ❌ Tidak ada
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <a href="Main.php?edit_id=<?= urlencode($film->getId()); ?>" class="edit">Update</a>
                            <a href="Main.php?action=hapus&id=<?= urlencode($film->getId()); ?>" class="delete" onclick="return confirm('Yakin hapus data film ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (isset($_GET['cari'])): ?>
        <div style="text-align:center;">
            <a href="Main.php" class="btn-showall">🔄 Tampilkan Semua</a>
        </div>
    <?php endif; ?>

    <div class="reset-container">
        <form action="Main.php" method="POST">
            <button type="submit" name="reset_data" class="btn-reset" onclick="return confirm('Hapus semua data film?');">🧹 Reset Data</button>
        </form>
    </div>
</div>
</body>
</html>