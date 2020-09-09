<?php     
    //Data Source Name, necessário para conectar com o banco
    //possui o nome do host e do banco
    $pdoDSN = "mysql:dbname=callsys;host=127.0.0.1";
    $pdoUsuario = "root";
    $pdoSenha = "";

    //objeto PDO para conexão com o banco
    $pdo = new PDO($pdoDSN, $pdoUsuario, $pdoSenha);        
?>