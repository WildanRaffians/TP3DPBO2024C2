<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Bahan.php');
include('classes/Template.php');

$bahan = new Bahan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$bahan->open();
$bahan->getBahan();

//Untuk menambah data
//cek apakah mendapat 'id
if (!isset($_GET['id'])) {
    //jika tidak
    if (isset($_POST['btn-submit'])) {
        //jika tombol 'btn-submit' ditekan
        if ($bahan->addBahan($_POST) > 0) {
            //tambah bahan berhasil
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'bahan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'bahan.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

//siapkan view untuk tabel
$view = new Template('templates/skintabel.html');

//inisialisasi
$mainTitle = 'Bahan';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Bahan</th>
<th scope="row">Deskripsi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'bahan';

//tampilkan tabel
while ($div = $bahan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_bahan'] . '</td>
    <td>' . $div['deskripsi'] . '</td>
    <td style="font-size: 22px;">
        <a href="update.php?id_bahan=' . $div['id_bahan'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="#" onclick="confirmDelete(' .  $div['id_bahan'] . ');" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

//Untuk mengupdate bahan
//cek apakah mendapat 'id'
if (isset($_GET['id'])) {
    //jika iya
    $id = $_GET['id'];  //tampung 'id'
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            //jika ditekan tombol 'submit'
            //simpan update
            if ($bahan->updateBahan($id, $_POST) > 0) {
                //update berhasil
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'bahan.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'bahan.php';
            </script>";
            }
        }

        $bahan->getBahanById($id);
        $row = $bahan->getResult();

        $dataUpdate = $row['nama_bahan'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

//menghapus bahan
//jika mendapat 'hapus'
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($bahan->deleteBahan($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'bahan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'bahan.php';
            </script>";
        }
    }
}

$bahan->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
?>

<!-- Pop up confirm delete -->
<script>
    function confirmDelete(id) {
        if (confirm("Produk dengan Bahan ini akan ikut terhapus. \nApakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = 'bahan.php?hapus=' + id;
        }
    }
</script>