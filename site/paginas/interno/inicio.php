<?php
session_start();
// Script PHP que verifica a chave de login da sesão
require_once "../../servicos/login/verificarLogin.php";
?>

<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="../../estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../estilos/interno/interno.css" />
    <meta charset="utf-8" />
    <title>CallSYS - Início</title>
</head>

<body>
    <nav>
        <?php require_once "nav.php"; ?>
    </nav>
    <section>
        <h1>Bem-vindo ao sistema!</h1>
    </section>
    <footer>
        <?php require_once "footer.php"; ?>
    </footer>
</body>

</html>