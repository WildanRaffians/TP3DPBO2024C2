<?php

class Bahan extends DB
{
    function getBahan()
    {
        $query = "SELECT * FROM bahan";
        return $this->execute($query);
    }

    function getBahanById($id)
    {
        $query = "SELECT * FROM bahan WHERE id_bahan = $id";
        return $this->execute($query);
    }

    function addBahan($data)
    {
        $nama = $data['nama'];
        $deskripsi = $data['deskripsi'];
        $query = "INSERT INTO bahan VALUES('', '$nama', '$deskripsi')";
        return $this->executeAffected($query);
    }

    function updateBahan($id, $data)
    {
        $nama = $data['nama'];
        $deskripsi = $data['deskripsi'];
        $query = "UPDATE bahan SET nama_bahan = '$nama', deskripsi = '$deskripsi' WHERE id_bahan = $id";
        return $this->executeAffected($query);
    }

    function deleteBahan($id)
    {
        $query = "DELETE FROM bahan WHERE id_bahan = $id";
        return $this->executeAffected($query);
    }
}
