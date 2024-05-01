<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Bahan.php');
include('classes/Produk.php');
include('classes/Template.php');


// if (isset($_GET['nilai'])) {
//     $nilai = $_GET['nilai'];

//     if ($nilai == 'produk') {
//         $produk = new Produk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
//         $produk->open();

//         $merk->getMerk();
//         $bahan->getBahan();

//         // $data = nulL;
//         if (isset($_POST['btn-submit'])) {
//             // Ambil data dari form
//             $data = array(
//                 'nama' => $_POST['nama'],
//                 'id_merk' => $_POST['id_merk'],
//                 'id_bahan' => $_POST['id_bahan'],
//                 'warna' => $_POST['warna'],
//                 'harga' => $_POST['harga']
//             );
//             $file = $_FILES['foto'];

//             // Panggil fungsi untuk menambahkan data
//             if ($produk->addData($data, $file)) {
//                 echo "<script>
//                     alert('Data berhasil ditambah!');
//                     document.location.href = 'index.php';
//                 </script>";
//                 exit;
//             } else {
//                 echo "<script>
//                     alert('Data gagal ditambah!');
//                     document.location.href = 'index.php';
//                 </script>";
//             }
//         }

//         $produk->close();
//         $view = new Template('templates/skinform.html');
//         $form = '<form method="post" enctype="multipart/form-data" class="tambah-data">
//         <div class="mb-3">
//             <label for="nama" class="form-label">Nama</label>
//             <input type="text" class="form-control" id="nama" name="nama" required>
//         </div>
//         <div class="mb-3">
//             <label for="id_merk" class="form-label">Merk</label>
//             <select class="form-control" id="id_merk" name="id_merk" required>
//                 <option value="">Pilih Merk</option>';
//                 while ($dataMerk = $merk->getResult()) {
//                     $form .= '<option value="' . $dataMerk['id_merk'] . '">' . $dataMerk['nama_merk'] . '</option>';
//                 }

//                 $form .= '</select>
//                     </div>
//                     <div class="mb-3">
//                     <label for="id_bahan" class="form-label">Bahan</label>
//                     <select class="form-control" id="id_bahan" name="id_bahan" required>
//                     <option value="">Pilih Bahan</option>';

//                 while ($dataBahan = $bahan->getResult()) {
//                     $form .= '<option value="' . $dataBahan['id_bahan'] . '">' . $dataBahan['nama_bahan'] . '</option>';
//                 }

//             $form .= '</select>
//         </div>
//         <div class="mb-3">
//             <label for="warna" class="form-label">Warna</label>
//             <input type="text" class="form-control" id="warna" name="warna" required>
//         </div>
//         <div class="mb-3">
//             <label for="harga" class="form-label">Harga</label>
//             <input type="number" class="form-control" id="harga" name="harga" required>
//         </div>
//         <div class="mb-3">
//             <label for="foto" class="form-label">Foto</label>
//             <input type="file" class="form-control" id="foto" name="foto" required>
//         </div>
//         <button type="submit" class="btn btn-primary" name="btn-submit">Submit</button>
//         </form>';
//         $namaForm = 'Produk';
//     }
// }

if (isset($_GET['id_produk'])) {
    $id = $_GET['id_produk'];
    $produk = new Produk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $produk->open();
    $merk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $merk->open();
    $bahan = new Bahan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $bahan->open();
    $produk->getProdukById($id);
    $dataProduk = $produk->getResult();
    $merk->getMerk();
    $bahan->getBahan();

    $fotoLama = $dataProduk['foto'];

    if (isset($_POST['btn-submit'])) {
        // Ambil data dari form
        $data = array(
            'nama' => $_POST['nama'],
            'id_merk' => $_POST['id_merk'],
            'warna' => $_POST['warna'],
            'id_bahan' => $_POST['id_bahan'],
            'harga' => $_POST['harga']
        );
        // Cek apakah file foto baru diunggah
        if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];
        } else {
            // Jika tidak, gunakan foto lama
            $file = $fotoLama;
        }
        
        // Panggil fungsi untuk menambahkan data
        if ($produk->updateData($id, $data, $file)) {
            echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'detail.php?id=$id';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'detail.php?id=$id';
            </script>";
        }
    }

    

    $form = '<form method="post" enctype="multipart/form-data" class="tambah-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="' . $dataProduk['nama_produk'] .'" required>
        </div>
        <div class="mb-3">
            <label for="id_merk" class="form-label">Merk</label>
            <select class="form-control" id="id_merk" name="id_merk" required>
                <option value="">Pilih Merk</option>';
                while ($dataMerk = $merk->getResult()) {
                    // Tandai opsi yang sesuai dengan data produk
                    $selected = ($dataMerk['id_merk'] == $dataProduk['id_merk']) ? 'selected' : '';
                    $form .= '<option value="' . $dataMerk['id_merk'] . '" ' . $selected . '>' . $dataMerk['nama_merk'] . '</option>';
                }

            $form .= '</select>
                </div>
                <div class="mb-3">
                <label for="id_bahan" class="form-label">Bahan</label>
                <select class="form-control" id="id_bahan" name="id_bahan" required>
                <option value="">Pilih Bahan</option>';

                while ($dataBahan = $bahan->getResult()) {
                    // Tandai opsi yang sesuai dengan data produk
                    $selected = ($dataBahan['id_bahan'] == $dataProduk['id_bahan']) ? 'selected' : '';
                    $form .= '<option value="' . $dataBahan['id_bahan'] . '" ' . $selected . '>' . $dataBahan['nama_bahan'] . '</option>';
                }

            $form .= '</select>
        </div>
        <div class="mb-3">
            <label for="warna" class="form-label">Warna</label>
            <input type="text" class="form-control" id="warna" name="warna" value="' . $dataProduk['warna'] .'" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="' . $dataProduk['harga'] .'" required>
        </div>
        <div class="mb-3">
        <label for="foto_lama" class="form-label">Foto Lama</label><br>
        <img src="assets/images/' . $dataProduk['foto'] . '" alt="Foto Lama" width="100"><br>
        <label for="foto" class="form-label">Foto Baru (jika ingin mengubah)</label>
        <input type="file" class="form-control" id="foto" name="foto">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" name="btn-submit">Submit</button>
        <a href="detail.php?id='.$id.'" class="btn btn-secondary">Cancel</a>
    </div>  
        </form>';
        $namaForm = 'Produk';
        $produk->close();
        $merk->close();
        $bahan->close();


} else if (isset($_GET['id_merk'])) {
    $id = $_GET['id_merk'];

    $merk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $merk->open();
    $merk->getMerkById($id);
    $dataMerk = $merk->getResult();

    $form = '<form method="post" enctype="multipart/form-data" class="tambah-data" action="merk.php?id=' . $id . '">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Merk</label>
            <input type="text" class="form-control" id="nama" name="nama" value="' . $dataMerk['nama_merk'] .'" required>
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal Negara Merk</label>
            <input type="text" class="form-control" id="asal" name="asal" value="' . $dataMerk['asal_merk'] .'" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="btn-submit">Submit</button>
            <a href="merk.php" class="btn btn-secondary">Cancel</a>
        </div>  
        </form>';
        $namaForm = 'Merk';
        $merk->close();
} else if (isset($_GET['id_bahan'])) {
    $id = $_GET['id_bahan'];

    $bahan = new Bahan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $bahan->open();
    $bahan->getBahanById($id);
    $dataBahan = $bahan->getResult();

    $form = '<form method="post" enctype="multipart/form-data" class="tambah-data" action="bahan.php?id=' . $id . '">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Bahan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="' . $dataBahan['nama_bahan'] .'" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="' . $dataBahan['deskripsi'] .'" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="btn-submit">Submit</button>
            <a href="bahan.php" class="btn btn-secondary">Cancel</a>
        </div>  
        </form>';
        $namaForm = 'Bahan';
        
        $bahan->close();
}
$aksi = 'Update';

$view = new Template('templates/skinform.html');
$view->replace('DATA_NAMA_FORM', $namaForm);
$view->replace('DATA_FORM', $form);
$view->replace('DATA_AKSI', $aksi);
$view->write();
