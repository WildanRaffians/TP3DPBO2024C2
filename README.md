<h1>TP3DPBO2024C2</h1>
<h3>Janji</h3>
Saya Wildan Hafizh Raffianshar NIM [2202301] mengerjakan soal Tugas Praktikum-3
dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan 
seperti yang telah dispesifikasikan. Aamiin

<h3>Deskripsi</h3>
PHP GUI dengan paradigma OOP, memperlakukan tampilan halaman web sebagai suatu object. Tema yang diambil adalah toko_pakaian.

<h3>Desain Program</h3>

![desain_db](https://github.com/WildanRaffians/TP3DPBO2024C2/assets/134181656/f49f4760-b2bd-4751-9d2c-ba315567e35d)

Program ini memiliki 3 kelas untuk merepresentasikan tabel pada database. 
<li>
  Kelas Produk representasi tabel Produk terdapat kolom id_produk sebagai primary key, nama_produk, id_merk sebagai foreign key ke tabel Merk dengan relasi many to one,
  warna produk, id_bahan sebagai foreign key ke tabel Bahan dengan relasi many to one, foto produk, dan harga produk. Pada Kelas ini terdapat method CRUD (create, read, update, delete) dan method searchProduk untuk fitur pencarian juga 
  method orderBy untuk melakukan pengurutan ascending berdasarkan nama produk, nama merk, nama bahan, dan harga produk.
</li>
<li>
  Kelas Merk representasi tabel Merk terdiri dari kolom id_merk sebagai primary key, nama merk dan asal negara merk. Di kelas ini juga terdapat method CRUD.
</li>
<li>
  Kelas Bahan representasi tabel Bahan terdiri dari kolom id_bahan sebagai primary key, nama bahan dan deskripsi bahan.
</li>

<h3>Alur Program</h3>
Saat program dijalankan maka akan menampilkan halaman depan dari web ini. Halaman depan ini menampilkan preview untuk list produk, terdapat foto, nama produk, merk dan bahannya. Jika ingin menambahkan data produk maka dapat memilih tambah produk di bagian navbar. JIka ingin melihat detail dari data produk dapat menekan salah satu produk yang ingin dilihat, di halaman detail ini terdapat tombol ubah data jika ingin mengedit data pproduk dan juga tombol hapus untuk menghapus produk.
<br>
<br>
Di halaman depan juga terdapat fitur search pada kanan navbar, yang mana kita dapat mencari produk tertentu yang diinginkan berdasarkan namanya. Terdapat juga fitur OrderBy untuk mengurutkan produk yang ditampilkan, terdapat beberapa pilihan yaitu order by nama, merk (nama merk), bahan (nama bahan), dan harga. Semuanya diurutkan secara ascending.
<br>
<br>
Kemudian pada navbar terdapat pilihan daftar merk dan daftar bahan, yang mana keduanya akan menampilkan sebuah tabel dari merk atau bahan. Pada halaman tabel terdapat pilihan edit tabel dan hapus tabel pada kolom paling kanan. Jika ingin menambah data maka opsi tambah produk pada navbar sebelumnya akan menjadi opsi tambah data dari tabel yang sedang dibuka. Kita bisa memilih fitur tambah data ini untuk menambah data pada tabel tertentu.

<h3>Dokumentasi</h3>

![Screenshot 2024-05-04 171342](https://github.com/WildanRaffians/TP3DPBO2024C2/assets/134181656/a62b27d9-b4e1-4862-b78e-2d687cbbdead)
![Screenshot 2024-05-04 171352](https://github.com/WildanRaffians/TP3DPBO2024C2/assets/134181656/96e4ad63-0523-4402-bab5-7d4a8a4a4938)
![Screenshot 2024-05-04 175121](https://github.com/WildanRaffians/TP3DPBO2024C2/assets/134181656/975b80e2-c93e-43ba-8558-0fd0fe19dc7c)
![Screenshot 2024-05-04 175227](https://github.com/WildanRaffians/TP3DPBO2024C2/assets/134181656/1d4fe075-b453-4841-9180-37a8e9faac25)
![Screenshot 2024-05-04 171400](https://github.com/WildanRaffians/TP3DPBO2024C2/assets/134181656/9a24e2d8-76c5-4d1e-8296-4d2ced0c8cf0)
![Screenshot 2024-05-04 175309](https://github.com/WildanRaffians/TP3DPBO2024C2/assets/134181656/5dd66fdb-a2b1-4a49-92b9-ec67db7fa660)

