<?php

class Mahasiswa_model
{
    private $table = "mahasiswa";
    private $koneksi;

    public function __construct()
    {
        $this->koneksi = new Database();
    }

    public function getAllMahasiswa()
    {
        $this->koneksi->query("SELECT * FROM " . $this->table);
        return $this->koneksi->resultSet();
    }

    public function getMahasiswa($id)
    {
        $this->koneksi->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->koneksi->bind("id", $id);
        return $this->koneksi->single();
    }
    public function tambahMahasiswa($post)
    {
        $query = "INSERT INTO " . $this->table . " VALUES('',:nama,:npm,:email,:jurusan)";
        $this->koneksi->query($query);
        $this->koneksi->bind("nama", $post['nama']);
        $this->koneksi->bind("npm", $post['npm']);
        $this->koneksi->bind("email", $post['email']);
        $this->koneksi->bind("jurusan", $post['jurusan']);
        $this->koneksi->execute();
        return $this->koneksi->rowCount();
    }

    public function ubahMahasiswa($post)
    {
        $query = "UPDATE " . $this->table . " SET
         nama=:nama,
         npm=:npm,
         email=:email,
         jurusan=:jurusan WHERE id=:id";
        $this->koneksi->query($query);
        $this->koneksi->bind("id", $post['id']);
        $this->koneksi->bind("nama", $post['nama']);
        $this->koneksi->bind("npm", $post['npm']);
        $this->koneksi->bind("email", $post['email']);
        $this->koneksi->bind("jurusan", $post['jurusan']);
        $this->koneksi->execute();
        return $this->koneksi->rowCount();
    }

    public function hapusMahasiswa($id)
    {
        $this->koneksi->query("DELETE FROM " . $this->table . " WHERE id=:id");
        $this->koneksi->bind("id", $id);
        $this->koneksi->execute();
        return $this->koneksi->rowCount();
    }
}