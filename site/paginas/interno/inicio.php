<?php
session_start();

require_once "../../servicos/login/verificarLogin.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../estilos/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../estilos/interno.css" />
    <meta charset="utf-8" />
    <title>CallSYS - Início</title>
</head>

<body>
    <nav>
        <?php require_once "nav.php"; ?>
    </nav>
    <section>
        <h1>Bem-vindo ao Sistema!</h1>
    </section>
    <footer>
        <?php require_once "footer.php"; ?>
    </footer>
</body>

</html>