<?php
require_once '../koneksi.php';

class M_tabel9
{
    protected $aliases;
    protected $conn;

    public function __construct($aliases, $conn)
    {
        $this->aliases = $aliases;
        $this->conn = $conn;
    }

    public function ambildata()
    {
        $sql = "SELECT * FROM {$this->aliases['tabel9']} ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ambil_tabel9_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel9']} WHERE {$this->aliases['tabel9_field1']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ambil_tabel4_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel9']} WHERE {$this->aliases['tabel9_field1']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ambil_tabel6_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel9']} WHERE {$this->aliases['tabel9_field1']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function cek_tabel9_field3($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel9']} WHERE {$this->aliases['tabel9_field3']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ceklogin($param1, $param2)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel9']} WHERE {$this->aliases['tabel9_field3']} = '$param1' AND {$this->aliases['tabel9_field4']} = '$param2' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO {$this->aliases['tabel9']} ($columns) VALUES ($values)";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function update($data, $param1)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE {$this->aliases['tabel9']} SET $set WHERE {$this->aliases['tabel9_field1']} = '$param1'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function updateCount($param1)
    {
        $sql = "UPDATE {$this->aliases['tabel9']} SET {$this->aliases['tabel9_field7']} = {$this->aliases['tabel9_field7']} + 1 WHERE {$this->aliases['tabel9_field1']} = '$param1'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    // public function hapus($param1)
    // {
    //     $sql = "DELETE FROM {$this->aliases['tabel9']} WHERE {$this->aliases['tabel9_field1']} = '$param1'";
    //     $result = mysqli_query($this->conn, $sql);
    //     return $result;
    // }
}
