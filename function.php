<?php

//Koneksi ke database
$database = mysqli_connect("localhost", "root","", "siWali");

function query($query)
{
    global $database;
    $result = mysqli_query($database, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function login($data)
{
    global $database;
    $NIP_login = $data["NIP"];
    $pass_login = $data["password"];

    if ($NIP_login == 'admin' AND $pass_login = 'admin'){
        $query = "INSERT INTO login(NIP, password) VALUES
            ('$NIP_login', '$pass_login')";
        mysqli_query($database, $query);
        return 2;
    }
    $query = "SELECT * FROM guru WHERE 
            NIP IN('$NIP_login') AND password IN ('$pass_login')";

    $result = mysqli_query($database, $query);

    if (mysqli_num_rows($result) === 1) {
        $query = "INSERT INTO login(NIP, password) VALUES
            ('$NIP_login', '$pass_login')";

        mysqli_query($database, $query);

        return 1;
    } else {
        return 0;
    }
}

function logout()
{
    global $database;

    mysqli_query($database, "DELETE FROM login WHERE 1");

    return 1;
}

function createGuru($data){
    global $database;

    $in_NIP = $data['NIP'];
    $in_nama = $data['nama'];
    $in_kodeKelas = $data['kodeKelas'];
    $in_password = $data['password'];
    $in_validation = $data['validation'];
    $in_alamat = $data['alamat'];
    $in_telepon = $data['telepon'];

    $query = "INSERT INTO guru(NIP, nama, kodeKelas, password, alamat, telepon) VALUES
        ('$in_NIP', '$in_nama', '$in_kodeKelas', '$in_password', '$in_alamat', '$in_telepon')";

    if ($in_password == $in_validation) {
        mysqli_query($database, $query);
        return 1;
    } else {
        return 0;
    }
}