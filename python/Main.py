from Film import Film

daftarFilm = [] # deklarasi list kosong untuk menampung data film

# fungsi untuk menentukan id unik
def isIdExists(id_film):
    ada = False # flag
    i = 0 # index
    while i < len(daftarFilm) and not ada: # looping ke semua elemen, berhenti jika sudah ketemu
        if daftarFilm[i].getId() == id_film: # jika elemen ada yang sama
            ada = True # id sudah ada
        i += 1 # lanjut ke elemen berikutnya
    return ada # True jika id sudah ada, False jika elemen itu unik

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
    id_film = 0
    id_valid = False # flag validasi ID
    # Validasi ID unik dan integer
    while not id_valid:
        try:
            id_film = int(input("ID Film: ")) # input
            if not isIdExists(id_film): # jika id unik
                id_valid = True
            else:
                print("ID ini sudah ada. Silakan masukkan ID lain.") # jika id tidak unik
        except ValueError:
            print("Input tidak valid. Masukkan angka.")
    
    judul = input("Judul Film: ") # input
    genre = input("Genre Film: ") # input

    durasi = 0
    durasi_valid = False # flag validasi durasi
    # Validasi input numerik untuk durasi
    while not durasi_valid:
        try:
            durasi = int(input("Durasi (menit): "))
            if durasi < 0: # jika input negatif
                print("Input tidak valid. Durasi tidak boleh negatif.")
            else:
                durasi_valid = True
        except ValueError: # jika input bukan angka
            print("Input tidak valid. Masukkan angka.")
            
    harga = 0
    harga_valid = False # flag validasi harga
    # Validasi input numerik untuk harga
    while not harga_valid:
        try:
            harga = int(input("Harga Tiket (Rp): "))
            if harga <= 0: # jika input kurang dari atau sama dengan nol
                print("Input tidak valid. Harga harus lebih dari 0.")
            else:
                harga_valid = True
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
    i = 0 # index
    while i < len(daftarFilm) and not found: # looping ke semua elemen film, berhenti jika sudah ketemu
        film = daftarFilm[i]
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
        i += 1 # lanjut ke elemen berikutnya

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
    i = 0 # index
    while i < len(daftarFilm) and not found: # looping ke semua elemen, berhenti jika sudah ketemu
        if daftarFilm[i].getId() == id_hapus: # jika ditemukan id yang dicari
            daftarFilm.pop(i) # hapus data
            found = True # flag true
            print("\nData film berhasil dihapus")
        i += 1 # lanjut ke elemen berikutnya

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
    i = 0 # index
    while i < len(daftarFilm) and not found: # looping ke semua elemen, berhenti jika sudah ketemu
        film = daftarFilm[i]
        if film.getId() == id_cari: # jika ditemukan id yang dicari
            print("\nData film ditemukan:")
            film.tampilkanData() # menampilkan data
            found = True
        i += 1 # lanjut ke elemen berikutnya

    if not found: # jika tidak ditemukan
        print(f"Film dengan ID {id_cari} tidak ditemukan")

# main program
def main():
    pilihan = ""
    while pilihan != '6': # berhenti jika user memilih 6 (Keluar)
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
        else:
            print("Pilihan tidak valid. Coba lagi")

if __name__ == "__main__":
    main()