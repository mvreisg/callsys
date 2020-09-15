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
    <meta charset="utf-8" />
    <title>CallSYS - Cadastrar Usuário</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
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