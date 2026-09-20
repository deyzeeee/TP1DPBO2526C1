# deklarasi class Film
class Film:
    # contructor
    def __init__(self, id_film:int, judul:str, genre:str, durasi:int, harga:int):
        self.__id_film:int = id_film
        self.__judul:str = judul
        self.__genre:str = genre
        self.__durasi:int = durasi  # dalam menit
        self.__harga:int = harga    # harga tiket dalam rupiah

    # getter (mengambil data)
    def getId(self) -> int:
        return self.__id_film # mengembalikan nilai

    def getJudul(self) -> str:
        return self.__judul # mengembalikan nilai

    def getGenre(self) -> str:
        return self.__genre # mengembalikan nilai

    def getDurasi(self) -> int:
        return self.__durasi # mengembalikan nilai

    def getHarga(self) -> int:
        return self.__harga # mengembalikan nilai

    # setter (untuk merubah value)
    def setId(self, id_film: int):
        self.__id_film = id_film # mengubah value id_film

    def setJudul(self, judul:str):
        self.__judul = judul # mengubah value atribut dengan value baru

    def setGenre(self, genre:str):
        self.__genre = genre # mengubah value atribut dengan value baru

    def setDurasi(self, durasi:int):
        if durasi >= 0: # durasi harus lebih dari 0 dan tidak boleh negatif
            self.__durasi = durasi # mengubah value atribut dengan value baru
        else:
            print("Durasi tidak boleh negatif.") # pesan jika angka negatif

    def setHarga(self, harga:int):
        if harga > 0: # harga harus lebih dari 0 dan tidak boleh negatif
            self.__harga = harga # mengubah value atribut dengan value baru
        else:
            print("Harga harus lebih dari 0.") # pesan jika angka negatif

    # prosedur untuk menampilkan data
    def tampilkanData(self):
        # print data
        print("ID Film :", self.getId())
        print("Judul :", self.getJudul())
        print("Genre :", self.getGenre())
        print("Durasi :", self.getDurasi(), "menit")
        print("Harga Tiket : Rp.", self.getHarga(),)