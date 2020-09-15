<?php
session_start();

// Importa a classe de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Script PHP que verifica a chave de login da sesão
require_once "../../../servicos/login/verificarLogin.php";

// URL de redirecionamento para a página de pesquisa
$urlPesquisa = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/pesquisa.php";
?>

<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/interno.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/usuario/cadastro.css" />
    <script type="application/javascript" src="../../../scripts/interno/usuario/cadastro.js"></script>
    <meta charset="utf-8" />
    <title>CallSYS - Cadastrar Usuário</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <button onclick="redirecionarParaPesquisa('<?php print $urlPesquisa; ?>');">&#8592; Voltar</button>
        <h1>Cadastrar Usuário</h1>
        <?php
        if (isset($_GET['insert'])) {
            switch ($_GET['insert']) {
                case "sucesso":
                    print "<p style='color: green'>Usuário cadastrado com sucesso</p>";
                    break;
                case "falha":
                    print "<p style='color: red'>Falha ao cadastrar o usuário</p>";
                    break;
            }
        }
        ?>
        <form name="form_cadastro_usuario" method="post">
            <!-- Nome -->
            <div>
                <label class="block" for="nome">Nome</label>
                <input class="block" type="text" name="nome" placeholder="" required />
            </div>

            <!-- Usuário -->
            <div>
                <label class="block" for="usuario">Usuário</label>
                <input class="block" type="text" name="usuario" placeholder="" required />
            </div>

            <!-- Senha -->
            <div>
                <label class="block" for="senha">Senha</label>
                <input class="block" type="password" name="senha" placeholder="" required />
            </div>

            <!-- Setor -->
            <div>
                <label class="block" for="setor">Setor</label>
                <select class="block" name="setor">
                    <?php require_once "../../../servicos/operacao/setor/optionsSetor.php"; ?>
                </select>
            </div>

            <!-- Função -->
            <div>
                <label class="block" for="funcao">Função</label>
                <select class="block" name="funcao">
                    <?php require_once "../../../servicos/operacao/funcao/optionsFuncao.php"; ?>
                </select>
            </div>

            <!-- Nível de Acesso -->
            <div>
                <label class="block" for="nivel_acesso">Nível de Acesso</label>
                <select class="block" name="nivel_acesso">
                    <?php require_once "../../../servicos/operacao/nivel_acesso/optionsNivelAcesso.php"; ?>
                </select>
            </div>

            <!-- Ativo -->
            <div>
                <label class="inline-block" for="ativo">Ativo</label>
                <input class="inline-block" type="checkbox" name="ativo">
            </div>

            <!-- Ações -->
            <div>
                <!-- Confirmar -->
                <input class="inline-block" type="submit" name="confirmar" value="Confirmar" formaction="../../../servicos/operacao/usuario/cadastro.php" />

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