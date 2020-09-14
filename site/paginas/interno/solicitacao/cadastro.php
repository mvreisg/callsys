<?php
session_start();

// Verifica se há login
require_once "../../../servicos/login/verificarLogin.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/import_fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/geral.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno.css" />
    <meta charset="utf-8" />
    <title>CallSYS - Cadastrar Solicitação</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Cadastrar Solicitação</h1>
        <?php
        if (isset($_GET['insert'])) {
            switch ($_GET['insert']) {
                case "erro":
                    print "<p style='color: red;'>Erro ao cadastrar a solicitação</p>";
                    break;
                case "sucesso":
                    print "<p style='color: green;'>Solicitação feita com sucesso!</p>";
                    break;
            }
        }
        if (isset($_GET['usuario'])) {
            if ($_GET['usuario'] == 0) {
                print "<p style='color: red;'>Usuário inválido</p>";
            }
        }
        if (isset($_GET['descricao_problema'])) {
            if ($_GET['descricao_problema'] == 0) {
                print "<p style='color: red;'>Por favor, descreva o problema</p>";
            }
        }
        ?>
        <form name="form_cadastro_solicitacao" action="../../../servicos/operacao/solicitacao/cadastro.php" method="post">
            <!-- Usuario -->
            <div>
                <label class="block" for="id_usuario">Usuário</label>
                <select class="block" name="id_usuario">
                    <?php require_once "../../../servicos/operacao/usuario/optionsUsuario.php"; ?>
                </select>
            </div>

            <!-- Setor 
            <div>
                <label class="block" for="setor">Setor</label>
                <input type="text" name="setor" placeholder="ID" disabled />
            </div>
            -->

            <!-- Equipamento -->
            <div>
                <span class="block">Selecionar Equipamento</span>
                <?php require_once "../../../servicos/operacao/solicitacao/checkboxesEquipamento.php"; ?>
            </div>

            <!-- Descrição do Problema -->
            <div>
                <label class="block" for="descricao_problema">Descreva o problema:</label>
                <textarea name="descricao_problema" rows="20" cols="50" placeholder="Mouse quebrou, clique duplo, etc."></textarea>
            </div>

            <!--
                <p>Estado</p>
                <input type="text" name="" placeholder="Em andamento"><br>                
            -->

            <!-- Ações -->
            <div>
                <!-- Confirmar -->
                <input class="inline-block" type="submit" name="submit" value="Solicitar" />

                <!-- Cancelar -->
                <input class="inline-block" type="button" value="Cancelar" />

                <!-- Limpar -->
                <input class="inline-block" type="button" value="Limpar" />
            </div>
        </form>
    </section>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
</body>

</html>