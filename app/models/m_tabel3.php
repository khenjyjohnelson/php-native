<?php

require_once '../koneksi.php';

class M_tabel3
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
        $query = "SELECT * FROM {$this->aliases['tabel3']} ORDER BY {$this->aliases['tabel3_field1']} DESC";
        return $this->db->query($query);
    }

    public function ambil_tabel3_field1($param1)
    {
        $query = "SELECT * FROM {$this->aliases['tabel3']} WHERE {$this->aliases['tabel3_field1']} = '$param1' ORDER BY {$this->aliases['tabel3_field1']} DESC";
        return $this->db->query($query);
    }

    public function simpan($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO {$this->aliases['tabel3']} ($columns) VALUES ($values)";
        return $this->db->query($query);
    }

    public function update($data, $param1)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE {$this->aliases['tabel3']} SET $set WHERE {$this->aliases['tabel3_field1']} = '$param1'";
        return $this->db->query($query);
    }

    // public function hapus($param1)
    // {
    //     $query = "DELETE FROM {$this->aliases['tabel3']} WHERE {$this->aliases['tabel3_field1']} = '$param1'";
    //     return $this->db->query($query);
    // }
}
