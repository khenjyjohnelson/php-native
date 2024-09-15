<?php

require_once '../koneksi.php';

class M_tabel5
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
        $sql = "SELECT * FROM {$this->aliases['tabel5']} ORDER BY {$this->aliases['tabel5_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ambil_tabel5_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel5']} WHERE {$this->aliases['tabel5_field1']} = '$param1' ORDER BY {$this->aliases['tabel5_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO {$this->aliases['tabel5']} ($columns) VALUES ($values)";
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
        $sql = "UPDATE {$this->aliases['tabel5']} SET $set WHERE {$this->aliases['tabel5_field1']} = '$param1'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function hapus($param1)
    {
        $sql = "DELETE FROM {$this->aliases['tabel5']} WHERE {$this->aliases['tabel5_field1']} = '$param1'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}
