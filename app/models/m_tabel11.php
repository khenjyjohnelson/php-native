<?php
require_once '../koneksi.php';

class M_tabel11
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
        $sql = "SELECT * FROM {$this->aliases['tabel11']} ORDER BY {$this->aliases['tabel11_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function ambil_tabel11_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel11']} WHERE {$this->aliases['tabel11_field1']} = '$param1' ORDER BY {$this->aliases['tabel11_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO {$this->aliases['tabel11']} ($columns) VALUES ($values)";
        return mysqli_query($this->conn, $sql);
    }

    public function update($data, $param1)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE {$this->aliases['tabel11']} SET $set WHERE {$this->aliases['tabel11_field1']} = '$param1'";
        return mysqli_query($this->conn, $sql);
    }

    // public function hapus($param1)
    // {
    //     $sql = "DELETE FROM {$this->aliases['tabel11']} WHERE {$this->aliases['tabel11_field1']} = '$param1'";
    //     return mysqli_query($this->conn, $sql);
    // }
}
