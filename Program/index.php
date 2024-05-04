<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Bahan.php');
include('classes/Produk.php');
include('classes/Template.php');

// buat instance produk
$listProduk = new Produk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listProduk->open();
// tampilkan data Produk
$listProduk->getProdukJoin();

// cari Produk
if (isset($_POST['btn-cari'])) {
    // methode mencari data Produk
    $listProduk->searchProduk($_POST['cari']);
} else if (isset($_GET['orderBy'])) {
    $order = $_GET['orderBy'];

    if($order == 'harga'){
        $listProduk->getProdukOrderByHargaAscending();
    } else if($order == 'nama'){
        $listProduk->getProdukOrderByNamaAscending();
    } else if($order == 'merk'){
        $listProduk->getProdukOrderByMerkAscending();
    }else if($order == 'bahan'){
        $listProduk->getProdukOrderByBahanAscending();
    }
}
else {
    // method menampilkan data Produk
    $listProduk->getProdukJoin();
    
}

$data = null;

// ambil data Produk
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listProduk->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['id_produk'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto'] . '" class="card-img-top" alt="' . $row['foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['nama_produk'] . '</p>
                <p class="card-text divisi-nama">' . $row['nama_merk'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['nama_bahan'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listProduk->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PRODUK', $data);
$home->write();
