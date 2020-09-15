<?php
session_start();

// Verifica se há login
require_once "../../../servicos/login/verificarLogin.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/interno.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/funcao/pesquisa.css" />
    <meta charset="utf-8" />
    <title>CallSYS - Funções</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Funções</h1>
        <div id="pesquisa">
            <input name="input_pesquisa" type="text" placeholder="Nome" />
            <button onclick="">Pesquisar</button>
        </div>
        <div id="cadastro">
            <button onclick="">Cadastrar</button>
        </div>
        <div id="funcoes">
            <table>
                <tr>
                    <th>Ativo</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Operações</th>
                </tr>
            </table>
        </div>
    </section>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
</body>

</html>