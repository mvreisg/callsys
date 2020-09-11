<?php
session_start();

// Verifica se há login
require_once "../../../servicos/login/verificarLogin.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/geral.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/cadastro.css" />
    <meta charset="utf-8" />
    <title>CallSYS - Cadastrar Nível de Acesso</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Cadastrar Nível de Acesso</h1>
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
        <form name="form_cadastro_nivel_acesso" action="../../../servicos/cadastro/nivel_acesso/cadastro.php" method="post">
            <!-- Nome -->
            <div>
                <label class="block" for="nome">Nome</label>
                <input type="text" name="nome" required />
            </div>

            <!-- Ativo -->
            <div>
                <label for="ativo">Ativo</label>
                <input type="checkbox" name="ativo">
            </div>

            <!-- Ações -->
            <div>
                <!-- Confirmar -->
                <input class="inline-block" type="submit" name="confirmar" value="Confirmar">

                <!-- Cancelar -->
                <input class="inline-block" type="button" name="cancelar" value="Cancelar">

                <!-- Limpar -->
                <input class="inline-block" type="button" name="limpar" value="Limpar">
            </div>
        </form>
    </section>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
</body>

</html>