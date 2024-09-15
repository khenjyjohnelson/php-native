<?php

require_once '../koneksi.php';

class M_tabel6
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
        $sql = "SELECT * FROM {$this->aliases['tabel6']} ORDER BY {$this->aliases['tabel6_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function getChartTabel8()
    {
        $query = "SELECT t6.{$this->aliases['tabel6_field2']} AS label, 
		COUNT(t8.{$this->aliases['tabel8_field1']}) AS value
		FROM {$this->aliases['tabel6']} AS t6
        LEFT JOIN {$this->aliases['tabel8']} AS t8 
		ON t6.{$this->aliases['tabel6_field1']} = t8.{$this->aliases['tabel6_field1']}
        GROUP BY t6.{$this->aliases['tabel6_field1']}";

        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getChartTabel2()
    {
        $query = "SELECT t6.{$this->aliases['tabel6_field2']} AS label, 
		COUNT(t2.{$this->aliases['tabel2_field2']}) AS value
		FROM {$this->aliases['tabel6']} AS t6
		LEFT JOIN {$this->aliases['tabel2']} AS t2 
		ON t6.{$this->aliases['tabel6_field1']} = t2.{$this->aliases['tabel6_field1']}
		GROUP BY t6.{$this->aliases['tabel6_field1']}";

        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function ambil_tabel6_field1($param1)
    {
        $sql = "SELECT * FROM {$this->aliases['tabel6']} WHERE {$this->aliases['tabel6_field1']} = '$param1' ORDER BY {$this->aliases['tabel6_field1']} DESC";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO {$this->aliases['tabel6']} ($columns) VALUES ($values)";
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
        $sql = "UPDATE {$this->aliases['tabel6']} SET $set WHERE {$this->aliases['tabel6_field1']} = '$param1'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    // public function hapus($param1)
    // {
    //     $sql = "DELETE FROM {$this->aliases['tabel6']} WHERE {$this->aliases['tabel6_field1']} = '$param1'";
    //     $result = mysqli_query($this->conn, $sql);
    //     return $result;
    // }
}
