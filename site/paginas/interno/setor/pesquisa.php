<?php
session_start();

// Importa a classe de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// URL de redirecionamento para a página de cadastro
$urlCadastro = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/cadastro.php";

// Script PHP que verifica a chave de login da sesão
require_once "../../../servicos/login/verificarLogin.php";
?>

<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/interno.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/setor/pesquisa.css" />
    <script type="application/javascript" src="../../../scripts/interno/setor/pesquisa.js"></script>
    <meta charset="utf-8" />
    <title>CallSYS - Setores</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Setores</h1>
        <div id="pesquisa">
            <input name="input_pesquisa" type="text" placeholder="Nome" />
            <button onclick="">Pesquisar</button>
        </div>
        <div id="cadastro">
            <button onclick="redirecionarParaCadastro('<?php print $urlCadastro; ?>');">Cadastrar</button>
        </div>
        <div id="setores">
            <table>
                <tbody>
                    <tr>
                        <th>Ativo</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Operações</th>
                    </tr>
                    <?php require_once "../../../servicos/operacao/setor/pesquisa.php" ?>
                </tbody>
            </table>
        </div>
    </section>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
</body>

</html>