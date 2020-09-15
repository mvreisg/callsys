<?php
session_start();

// Importa a classe de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Script PHP que verifica a chave de login da sesão
require_once "../../../servicos/login/verificarLogin.php";

// URL de redirecionamento para a página de pesquisa
$urlPesquisa = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/pesquisa.php";
?>

<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/interno.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/funcao/cadastro.css" />
    <script type="application/javascript" src="../../../scripts/interno/funcao/cadastro.js"></script>
    <meta charset="utf-8" />
    <title>CallSYS - Cadastrar Função</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <button onclick="redirecionarParaPesquisa('<?php print $urlPesquisa; ?>');">&#8592; Voltar</button>
        <h1>Cadastrar Função</h1>
        <?php
        // TODO: invalidar GET após recebimento
        if (isset($_GET['insert'])) {
            switch ($_GET['insert']) {
                case "sucesso":
                    print "<p style='color: green;'>Função cadastrado com sucesso</p>";
                    break;
            }
        }
        ?>
        <form name="form_cadastro_funcao" method="post">
            <!-- Nome -->
            <div>
                <label class="block" for="nome">Nome</label>
                <input type="text" name="nome" required />
            </div>

            <!-- Ativo -->
            <div>
                <label for="ativo">Ativo</label>
                <input type="checkbox" name="ativo" />
            </div>

            <!-- Ações -->
            <div>
                <!-- Confirmar -->
                <input class="inline-block" type="submit" name="confirmar" value="Confirmar" formaction="../../../servicos/operacao/funcao/cadastro.php" />

                <!-- Cancelar -->
                <input class="inline-block" type="button" name="cancelar" value="Cancelar" />

                <!-- Limpar -->
                <input class="inline-block" type="button" name="limpar" value="Limpar" />
            </div>
        </form>
    </section>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
</body>

</html>