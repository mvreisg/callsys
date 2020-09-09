<?php     
    //Data Source Name, necessário para conectar com o banco
    //possui o nome do host e do banco
    $pdoDSN = "mysql:host=localhost;dbname=id14645824_estagio";
    $pdoUsuario = "id14645824_root";
    $pdoSenha = "wgV2+m?Y>6m^[^A>";

    //objeto PDO para conexão com o banco
    $pdo = new PDO($pdoDSN, $pdoUsuario, $pdoSenha);        
?>