<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Bahan.php');
include('classes/Produk.php');
include('classes/Template.php');

$produk = new Produk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$produk->open();

$data = nulL;

//Menampilakn detail data produk
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $produk->getProdukById($id);
        $row = $produk->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_produk'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto'] . '" class="img-thumbnail" alt="' . $row['foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama_produk'] . '</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>:</td>
                                    <td>' . $row['nama_merk'] . '</td>
                                </tr>
                                <tr>
                                    <td>Warna</td>
                                    <td>:</td>
                                    <td>' . $row['warna'] . '</td>
                                </tr>
                                <tr>
                                    <td>Bahan</td>
                                    <td>:</td>
                                    <td>' . $row['nama_bahan'] . '</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>Rp ' . number_format($row['harga'], 0, ',', '.') . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="update.php?id_produk='.$id .'"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="#" onclick="confirmDelete(' .  $row['id_produk'] . ');" class="btn btn-danger">Hapus Data</a>
                </div>';
                
    }
}


$detail = new Template('templates/skindetail.html');

//Hapus data produk
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($produk->deleteData($id) > 0) {
            echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'index.php';
            </script>";
        }
    }
}
$produk->close();
$detail->replace('DATA_DETAIL_PRODUK', $data);
$detail->write();
?>

<!-- Pop up confirm delete -->
<script>
    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = 'detail.php?hapus=' + id;
        }
    }
</script>