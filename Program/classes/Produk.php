<?php

class Produk extends DB
{
    function getProdukJoin()
    {
        $query = "SELECT * FROM produk JOIN merk ON produk.id_merk=merk.id_merk JOIN bahan ON produk.id_bahan=bahan.id_bahan ORDER BY produk.id_produk";

        return $this->execute($query);
    }

    function getProduk()
    {
        $query = "SELECT * FROM produk";
        return $this->execute($query);
    }

    function getProdukById($id)
    {
        $query = "SELECT * FROM produk JOIN merk ON produk.id_merk=merk.id_merk JOIN bahan ON produk.id_bahan=bahan.id_bahan WHERE id_produk=$id";
        return $this->execute($query);
    }

    function searchProduk($keyword)
    {
        $query = "SELECT * FROM produk 
                JOIN merk ON produk.id_merk=merk.id_merk 
                JOIN bahan ON produk.id_bahan=bahan.id_bahan 
                WHERE nama_produk LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $harga = $data['harga'];
        $nama = $data['nama'];
        $warna = $data['warna'];
        $id_merk = $data['id_merk'];
        $id_bahan = $data['id_bahan'];
        $foto = $file['name'];

        // Tentukan direktori tujuan
        $target_dir = "assets/images/";
        $target_file = $target_dir . basename($foto);

        // Pindahkan file yang diunggah ke direktori tujuan
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars(basename($foto)). " telah berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
        }

        $query = "INSERT INTO produk VALUES('', '$nama', $id_merk, '$warna', $id_bahan, '$foto', $harga)";
        $result = $this->executeAffected($query);
        return $result > 0;
    }


    function updateData($id, $data, $file)
    {
        $nama = $data['nama'];
        $id_merk = $data['id_merk'];
        $warna = $data['warna'];
        $id_bahan = $data['id_bahan'];
        $harga = $data['harga'];
    
        // Check if $file is a string (indicating the old file name) or an array (indicating a new file upload)
        if (is_array($file) && $file['error'] === UPLOAD_ERR_OK) {
            // Handle new file upload
            $foto = $file['name'];
            // Move the uploaded file to the desired directory
            move_uploaded_file($file['tmp_name'], 'assets/images/' . $foto);
        } else {
            // Use the old file name
            $foto = $file;
        }
    
        $query = "UPDATE produk SET nama_produk='$nama', id_merk=$id_merk, warna='$warna', id_bahan=$id_bahan, foto='$foto', harga=$harga WHERE id_produk=$id";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM produk WHERE id_produk=$id";
        return $this->executeAffected($query);
    }
}
