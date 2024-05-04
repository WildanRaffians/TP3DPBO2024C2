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
