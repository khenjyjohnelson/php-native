<?php
require_once '../koneksi.php';

class M_tabel8
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
        $sql = "SELECT * FROM {$this->aliases['tabel8']} ORDER BY {$this->aliases['tabel8_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ambil_tabel8_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel8']} WHERE {$this->aliases['tabel8_field1']} = '$param1' ORDER BY {$this->aliases['tabel8_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ambil_tabel8_field2($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel8']} WHERE {$this->aliases['tabel5_field1']} = '$param1' ORDER BY {$this->aliases['tabel8_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ambil_tabel9_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel8']} WHERE {$this->aliases['tabel9_field1']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function ambil_tabel9_field3($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel8']} WHERE {$this->aliases['tabel9_field3']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function cari($param1, $param2)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel8']} WHERE {$this->aliases['tabel8_field1']} = '$param1' AND {$this->aliases['tabel9_field3']} = '$param2' ORDER BY {$this->aliases['tabel8_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function filter($param1, $param2, $param3, $param4)
    {
        $filter = "SELECT * FROM {$this->aliases['tabel8']} WHERE {$this->aliases['tabel8_field10']} BETWEEN '$param1' AND '$param2' OR {$this->aliases['tabel8_field11']} BETWEEN '$param3' AND '$param4' ORDER BY {$this->aliases['tabel8_field1']} DESC";
        $result = mysqli_query($this->conn, $filter);
        return $result;
    }

    public function filter_tabel9($param1, $param2)
    {
        $filter = "SELECT * FROM {$this->aliases['tabel10']} WHERE {$this->aliases['tabel9_field1']} IN ($param2) AND {$this->aliases['tabel9_field1']} LIKE '%$param1%' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        $result = mysqli_query($this->conn, $filter);
        return $result;
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO {$this->aliases['tabel8']} ($columns) VALUES ($values)";
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
        $sql = "UPDATE {$this->aliases['tabel8']} SET $set WHERE {$this->aliases['tabel8_field1']} = '$param1'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function hapus($param1)
    {
        $sql = "DELETE FROM {$this->aliases['tabel8']} WHERE {$this->aliases['tabel8_field1']} = '$param1'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function hapus_status($param12)
    {
        $sql = "DELETE FROM {$this->aliases['tabel8']} WHERE {$this->aliases['tabel8_field12']} = '$param12'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}
