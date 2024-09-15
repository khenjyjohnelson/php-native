<?php
require_once '../koneksi.php';

class M_tabel10
{
    protected $aliases;
    protected $conn;

    public function __construct($aliases, $conn)
    {
        $this->aliases = $aliases;
        $this->conn = $conn;
    }

    public function join_tabel8()
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} 
                JOIN {$this->aliases['tabel8']} 
                ON {$this->aliases['tabel10']}.{$this->aliases['tabel8_field1']} = {$this->aliases['tabel8']}.{$this->aliases['tabel8_field1']}";
        return mysqli_query($this->conn, $sql);
    }

    public function join_tabel8_tamu($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} 
                JOIN {$this->aliases['tabel8']} 
                ON {$this->aliases['tabel10']}.{$this->aliases['tabel8_field1']} = {$this->aliases['tabel8']}.{$this->aliases['tabel8_field1']} 
                WHERE {$this->aliases['tabel10']}.{$this->aliases['tabel9_field1']} = $param1";
        return mysqli_query($this->conn, $sql);
    }

    public function join_tabel2()
    {
        $sql = "SELECT DISTINCT * FROM {$this->aliases['tabel10']} 
                JOIN {$this->aliases['tabel2']} 
                ON {$this->aliases['tabel10']}.{$this->aliases['tabel8_field1']} = {$this->aliases['tabel2']}.{$this->aliases['tabel8_field1']}";
        return mysqli_query($this->conn, $sql);
    }

    public function join_tabel2_tamu($param1)
    {
        $sql = "SELECT DISTINCT * FROM {$this->aliases['tabel10']} 
                JOIN {$this->aliases['tabel2']} 
                ON {$this->aliases['tabel10']}.{$this->aliases['tabel8_field1']} = {$this->aliases['tabel2']}.{$this->aliases['tabel8_field1']} 
                WHERE {$this->aliases['tabel10']}.{$this->aliases['tabel9_field1']} = $param1";
        return mysqli_query($this->conn, $sql);
    }

    public function ambildata()
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} ORDER BY {$this->aliases['tabel10_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function ambil_tabel10_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} WHERE {$this->aliases['tabel10_field1']} = '$param1' ORDER BY {$this->aliases['tabel10_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function ambil_tabel9_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} WHERE {$this->aliases['tabel9_field1']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function ambil_tabel10_field2($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} WHERE {$this->aliases['tabel8_field1']} = '$param1' ORDER BY {$this->aliases['tabel8_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function ambil_tabel9_field3($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} WHERE {$this->aliases['tabel9_field3']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function cari($param1, $param2)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} 
                WHERE {$this->aliases['tabel10_field1']} = '$param1' 
                AND {$this->aliases['tabel9_field3']} = '$param2' 
                ORDER BY {$this->aliases['tabel10_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function filter($min, $max)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel10']} 
                WHERE {$this->aliases['tabel10_field7']} BETWEEN '$min' AND '$max' 
                ORDER BY {$this->aliases['tabel10_field1']} DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO {$this->aliases['tabel10']} ($columns) VALUES ($values)";
        return mysqli_query($this->conn, $sql);
    }

    public function update($data, $param1)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE {$this->aliases['tabel10']} SET $set WHERE {$this->aliases['tabel10_field1']} = '$param1'";
        return mysqli_query($this->conn, $sql);
    }

    public function hapus($param1)
    {
        $sql = "DELETE FROM {$this->aliases['tabel10']} WHERE {$this->aliases['tabel10_field1']} = '$param1'";
        return mysqli_query($this->conn, $sql);
    }
}
