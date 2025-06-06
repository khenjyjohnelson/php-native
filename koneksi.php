<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "others_nandohong_inventory"; ;

$db = mysqli_connect($host , $user , $pass , $database);

if (!$db) {
    echo "Koneksi Ke Database Gagal" ;
}
else{
    echo "Koneksi Berhasil" ;
    
}
