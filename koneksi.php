<?php
    // PUNYA KO ANDO SIAHAAN
    $config = [
        'server' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'database' => 'prg5_20221',
    ];

    $con = new mysqli(
        $config["server"],
        $config["username"],
        $config["password"],
        $config["database"]
    );
    
    if ($con->connect_error){
        die("Connection failed: ".$con->connect_error);
    }
?>