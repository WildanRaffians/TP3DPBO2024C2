<?php

class Merk extends DB
{
    function getMerk()
    {
        $query = "SELECT * FROM merk";
        return $this->execute($query);
    }

    function getMerkById($id)
    {
        $query = "SELECT * FROM merk WHERE id_merk=$id";
        return $this->execute($query);
    }

    function addMerk($data)
    {
        $nama = $data['nama'];
        $asal = $data['asal'];
        $query = "INSERT INTO merk VALUES('', '$nama', '$asal')";
        return $this->executeAffected($query);
    }

    function updateMerk($id, $data)
    {
        $nama = $data['nama'];
        $asal = $data['asal'];
        $query = "UPDATE merk SET nama_merk = '$nama', asal_merk = '$asal' WHERE id_merk = $id";
        return $this->executeAffected($query);
    }

    function deleteMerk($id)
    {
        $query = "DELETE FROM merk WHERE id_merk = $id";
        return $this->executeAffected($query);
    }

}
