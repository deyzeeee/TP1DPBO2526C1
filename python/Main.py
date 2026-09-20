from Film import Film

daftarFilm = [] # deklarasi list kosong untuk menampung data film

# fungsi untuk menentukan id unik
def isIdExists(id_film):
    for film in daftarFilm: # looping ke semua elemen
        if film.getId() == id_film: # jika elemen ada yang sama
            return True # mengembalikan nilai true
    return False # jika elemen itu unik mengembalikan nilai false

# prosedur menampilkan menu
def tampilkanMenu():
    # print menu
    print("\n======== W3LC0M3 T0 H0L0 C1N3M4 ========")
    print("1. Tambah Data Film")
    print("2. Tampilkan Semua Data Film")
    print("3. Update Data Film")
    print("4. Hapus Data Film")
    print("5. Cari Data Film")
    print("6. Keluar")

# prosedur menambahkan data
def tambahData():
    print("\n--- Tambahkan Data Film ---")
    # Validasi ID unik dan integer
    while True:
        try:
            id_film = int(input("ID Film: ")) # input
            if not isIdExists(id_film): # jika id unik
                break
            print("ID ini sudah ada. Silakan masukkan ID lain.") # jika id tidak unik
        except ValueError:
            print("Input tidak valid. Masukkan angka.")
    
    judul = input("Judul Film: ") # input
    genre = input("Genre Film: ") # input

    # Validasi input numerik untuk durasi
    while True:
        try:
            durasi = int(input("Durasi (menit): "))
            if durasi < 0: # jika input negatif
                print("Input tidak valid. Durasi tidak boleh negatif.")
                continue # kembali ke awal loop
            break
        except ValueError: # jika input bukan angka
            print("Input tidak valid. Masukkan angka.")
            
    # Validasi input numerik untuk harga
    while True:
        try:
            harga = int(input("Harga Tiket (Rp): "))
            if harga <= 0: # jika input kurang dari atau sama dengan nol
                print("Input tidak valid. Harga harus lebih dari 0.")
                continue # kembali ke awal loop
            break
        except ValueError: # jika input bukan angka
            print("Input tidak valid. Masukkan angka.")

    film_baru = Film(id_film, judul, genre, durasi, harga)
    daftarFilm.append(film_baru) # memasukkan objek ke dalam array
    print("\nData film berhasil ditambahkan")

# prosedur menampilkan data
def tampilkanData():
    print("\n--- Daftar Film ---")
    if not daftarFilm: # jika daftar film kosong
        print("\nData film kosong")
    else:
        # jika daftar film ada
        for film in daftarFilm: # looping ke semua elemen array
            film.tampilkanData() # menampilkan data
            print() # newline

# prosedur untuk memperbarui data
def updateData():
    print("\n--- Update Data Film ---")
    try:
        id_update = int(input("Masukkan ID Film yang akan diupdate: ")) # input
    except ValueError:
        print("Input ID tidak valid. Harus berupa angka.")
        return

    found = False # flag
    for film in daftarFilm: # looping ke semua elemen film
        if film.getId() == id_update: # jika film ditemukan
            found = True

            # update ID film
            id_baru = input(f"ID Film baru ({film.getId()}): ") # input
            if id_baru: # jika input tidak kosong
                try:
                    id_baru_int = int(id_baru)
                    # Cek apakah ID baru berbeda dengan ID lama, dan apakah ID baru sudah ada di daftar
                    if id_baru_int != film.getId() and isIdExists(id_baru_int): 
                        print("ID ini sudah ada. Data tidak diubah.")
                    else:
                        film.setId(id_baru_int) # memasukkan value
                except ValueError: # jika input bukan angka
                    print("Input ID tidak valid. Data tidak diubah.")
            
            # update judul film
            print(f"Judul Film baru ({film.getJudul()}): ", end="")
            judul_baru = input()  # input
            if judul_baru:
                film.setJudul(judul_baru)

            # update genre film
            print(f"Genre baru ({film.getGenre()}): ", end="")
            genre_baru = input()  # input
            if genre_baru:
                film.setGenre(genre_baru)

            # update durasi film
            print(f"Durasi baru ({film.getDurasi()}): ", end="")
            durasi_baru = input() # input
            if durasi_baru:
                try:
                    durasi_baru_int = int(durasi_baru)
                    if durasi_baru_int < 0: # jika input negatif
                        print("Input durasi tidak valid. Durasi tidak boleh negatif.")
                    else:
                        film.setDurasi(durasi_baru_int) # memasukkan value
                except ValueError: # jika input bukan angka
                    print("Input durasi tidak valid. Data tidak diubah.")

            # update harga tiket
            print(f"Harga baru ({film.getHarga()}): ", end="")
            harga_baru = input() # input
            if harga_baru:
                try:
                    harga_baru_int = int(harga_baru)
                    if harga_baru_int <= 0:
                        print("Input harga tidak valid. Harga harus lebih dari 0.")
                    else:
                        film.setHarga(harga_baru_int) # memasukkan value
                except ValueError: # jika input tidak valid
                    print("Input harga tidak valid. Data tidak diubah.")

            print("\nData film berhasil diupdate")
            break

    if not found: # jika id tidak ditemukan
        print(f"Film dengan ID {id_update} tidak ditemukan")

# prosedur menghapus data
def hapusData():
    print("\n--- Hapus Data Film ---")
    try:
        id_hapus = int(input("Masukkan ID Film yang akan dihapus: ")) # input
    except ValueError:
        print("Input ID tidak valid. Harus berupa angka.")
        return

    found = False # flag
    for film in daftarFilm: # looping ke semua elemen
        if film.getId() == id_hapus: # jika ditemukan id yang dicari
            daftarFilm.remove(film) # hapus data
            found = True # flag true
            print("\nData film berhasil dihapus")
            break

    if not found: # jika tidak ditemukan
        print(f"Film dengan ID {id_hapus} tidak ditemukan")

# prosedur mencari data
def cariData():
    print("\n--- Cari Data Film ---")
    try:
        id_cari = int(input("Masukkan ID Film yang akan dicari: ")) # input
    except ValueError:
        print("Input ID tidak valid. Harus berupa angka.")
        return

    found = False # flag
    for film in daftarFilm: # looping ke semua elemen
        if film.getId() == id_cari: # jika ditemukan id yang dicari
            print("\nData film ditemukan:")
            film.tampilkanData() # menampilkan data
            found = True
            break

    if not found: # jika tidak ditemukan
        print(f"Film dengan ID {id_cari} tidak ditemukan")

# main program
def main():
    while True:
        tampilkanMenu() # menampilkan menu
        pilihan = input("Pilihan: ") # input opsi

        if pilihan == '1': # opsi 1
            tambahData() # menambah data
        elif pilihan == '2': # opsi 2
            tampilkanData() # menampilkan data
        elif pilihan == '3': # opsi 3
            updateData() # memperbarui data
        elif pilihan == '4': # opsi 4
            hapusData() # menghapus data
        elif pilihan == '5': # opsi 5
            cariData() # mencari data
        elif pilihan == '6': # opsi 6
            print("Terima kasih telah menggunakan program ini")
            break
        else:
            print("Pilihan tidak valid. Coba lagi")

if __name__ == "__main__":
    main()