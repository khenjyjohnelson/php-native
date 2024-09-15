<?php

require_once '../koneksi.php';

class M_tabel1
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
        $query = "SELECT * FROM {$this->aliases['tabel1']} ORDER BY {$this->aliases['tabel1_field1']} DESC";
        return $this->db->query($query);
    }

    public function ambil_tabel1_field1($param1)
    {
        $query = "SELECT * FROM {$this->aliases['tabel1']} WHERE {$this->aliases['tabel1_field1']} = '$param1' ORDER BY {$this->aliases['tabel1_field1']} DESC";
        return $this->db->query($query);
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO {$this->aliases['tabel1']} ($columns) VALUES ($values)";
        return $this->db->query($query);
    }

    public function update($data, $param1)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE {$this->aliases['tabel1']} SET $set WHERE {$this->aliases['tabel1_field1']} = '$param1'";
        return $this->db->query($query);
    }

    // public function hapus($param1)
    // {
    //     $query = "DELETE FROM {$this->aliases['tabel1']} WHERE {$this->aliases['tabel1_field1']} = '$param1'";
    //     return $this->db->query($query);
    // }
}
