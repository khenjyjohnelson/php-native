<?php

require_once '../koneksi.php';

class M_tabel2
{
    protected $aliases;
    protected $db;

    public function __construct($aliases, $db)
    {
        $this->aliases = $aliases;
        $this->db = $db;
    }

    public function ambildata()
    {
        $query = "SELECT * FROM {$this->aliases['tabel2']} ORDER BY {$this->aliases['tabel2_field1']} DESC";
        return $this->db->query($query);
    }

    public function ambil_tabel2_field1($param1)
    {
        $query = "SELECT * FROM {$this->aliases['tabel2']} WHERE {$this->aliases['tabel2_field1']} = '$param1' ORDER BY {$this->aliases['tabel2_field1']} DESC";
        return $this->db->query($query);
    }

    public function ambil_tabel9_field1($param1)
    {
        $query = "SELECT * FROM {$this->aliases['tabel2']} WHERE {$this->aliases['tabel9_field1']} = '$param1' ORDER BY {$this->aliases['tabel9_field1']} DESC";
        return $this->db->query($query);
    }

    public function ambil_tabel2_field2($param1)
    {
        $query = "SELECT * FROM {$this->aliases['tabel2']} WHERE {$this->aliases['tabel2_field2']} = '$param1' ORDER BY {$this->aliases['tabel2_field2']} DESC";
        return $this->db->query($query);
    }

    public function filter($param1, $param2, $param3, $param4)
    {
        $filter = "SELECT * FROM {$this->aliases['tabel2']} WHERE {$this->aliases['tabel2_field11']} BETWEEN '$param1' AND '$param2' OR {$this->aliases['tabel2_field12']} BETWEEN '$param3' AND '$param4' ORDER BY {$this->aliases['tabel2_field1']} DESC";
        return $this->db->query($filter);
    }

    public function filter_tabel4($param1, $param2, $param3, $param4, $param5)
    {
        $filter = "SELECT * FROM {$this->aliases['tabel2']} WHERE {$this->aliases['tabel9_field1']} IN ($param5) AND ({$this->aliases['tabel2_field11']} BETWEEN '$param1' AND '$param2' OR {$this->aliases['tabel2_field12']} BETWEEN '$param3' AND '$param4') ORDER BY {$this->aliases['tabel2_field1']} DESC";
        return $this->db->query($filter);
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO {$this->aliases['tabel2']} ($columns) VALUES ($values)";
        return $this->db->query($query);
    }

    public function update($data, $param1)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE {$this->aliases['tabel2']} SET $set WHERE {$this->aliases['tabel2_field2']} = '$param1'";
        return $this->db->query($query);
    }

    public function update_tabel2($data, $param1)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE {$this->aliases['tabel2']} SET $set WHERE {$this->aliases['tabel2_field2']} = '$param1'";
        return $this->db->query($query);
    }

    public function hapus($param1)
    {
        $query = "DELETE FROM {$this->aliases['tabel2']} WHERE {$this->aliases['tabel2_field1']} = '$param1'";
        return $this->db->query($query);
    }
}
