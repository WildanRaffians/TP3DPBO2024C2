<?php

class Produk extends DB
{
    //menampilkan produk yang sudah di join dengan bahan dan merk
    function getProdukJoin()
    {
        $query = "SELECT * FROM produk JOIN merk ON produk.id_merk=merk.id_merk JOIN bahan ON produk.id_bahan=bahan.id_bahan ORDER BY produk.id_produk";

        return $this->execute($query);
    }

    //menampilkan produk tanpa join
    function getProduk()
    {
        $query = "SELECT * FROM produk";
        return $this->execute($query);
    }

    //menampilkan produk dengan id tertentu (Join dengan merk dan bahan)
    function getProdukById($id)
    {
        $query = "SELECT * FROM produk JOIN merk ON produk.id_merk=merk.id_merk JOIN bahan ON produk.id_bahan=bahan.id_bahan WHERE id_produk=$id";
        return $this->execute($query);
    }

    //Fungsi menambahkan data
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

    //fungsi edit/update data
    function updateData($id, $data, $file)
    {
        $nama = $data['nama'];
        $id_merk = $data['id_merk'];
        $warna = $data['warna'];
        $id_bahan = $data['id_bahan'];
        $harga = $data['harga'];
    
        //cek apakah terdapat file foto baru yang di upload
        if (is_array($file) && $file['error'] === UPLOAD_ERR_OK) {
            // jika iya
            $foto = $file['name'];
            // Pindahkan file yang diunggah ke direktori tujuan
            move_uploaded_file($file['tmp_name'], 'assets/images/' . $foto);
        } else {
            // Jika tidak, gunakan foto lama
            $foto = $file;
        }
    
        $query = "UPDATE produk SET nama_produk='$nama', id_merk=$id_merk, warna='$warna', id_bahan=$id_bahan, foto='$foto', harga=$harga WHERE id_produk=$id";
        return $this->executeAffected($query);
    }

    //fungsi delete data
    function deleteData($id)
    {
        $query = "DELETE FROM produk WHERE id_produk=$id";
        return $this->executeAffected($query);
    }
    
    //fungsi searching berdasarkan nama
    function searchProduk($keyword)
    {
        $query = "SELECT * FROM produk 
                JOIN merk ON produk.id_merk=merk.id_merk 
                JOIN bahan ON produk.id_bahan=bahan.id_bahan 
                WHERE nama_produk LIKE '%$keyword%'";
        return $this->execute($query);
    }

    //fungsi sorting berdasarkan harga secara ascend
    function getProdukOrderByHargaAscending()
    {
        $query = "SELECT * FROM produk 
                JOIN merk ON produk.id_merk=merk.id_merk 
                JOIN bahan ON produk.id_bahan=bahan.id_bahan 
                ORDER BY harga ASC";
        return $this->execute($query);
    }
    
    //fungsi sorting berdasarkan nama produk secara ascend
    function getProdukOrderByNamaAscending()
    {
        $query = "SELECT * FROM produk 
                JOIN merk ON produk.id_merk=merk.id_merk 
                JOIN bahan ON produk.id_bahan=bahan.id_bahan 
                ORDER BY nama_produk ASC";
        return $this->execute($query);
    }
    
    //fungsi sorting berdasarkan nama merk secara ascend
    function getProdukOrderByMerkAscending()
    {
        $query = "SELECT * FROM produk 
                JOIN merk ON produk.id_merk=merk.id_merk 
                JOIN bahan ON produk.id_bahan=bahan.id_bahan 
                ORDER BY nama_merk ASC";
        return $this->execute($query);
    }
    
    //fungsi sorting berdasarkan nama bahan secara ascend
    function getProdukOrderByBahanAscending()
    {
        $query = "SELECT * FROM produk 
                JOIN merk ON produk.id_merk=merk.id_merk 
                JOIN bahan ON produk.id_bahan=bahan.id_bahan 
                ORDER BY nama_bahan ASC";
        return $this->execute($query);
    }
}
