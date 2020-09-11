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
    <title>CallSYS - Cadastrar Solicitação</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Cadastrar Solicitação</h1>
        <form name="form_cadastro_solicitacao" action="" method="post">
            <!-- Usuario -->
            <div>
                <label class="block" for="nome_usuario">Usuário</label>
                <input class="inline-block" type="text" name="id_usuario" placeholder="ID do usuário" disabled />
                <input class="inline-block" type="text" name="nome_usuario" placeholder="Nome do usuário" required />
                <input class="inline-block" type="button" name="pesquisar_usuario" value="Pesquisar" />
            </div>

            <!-- Setor -->
            <div>
                <label class="block" for="setor">Setor</label>
                <input type="text" name="setor" disabled />
            </div>

            <!-- Equipamento -->
            <div>
                <label class="block" for="nome_equipamento">Equipamento</label>
                <input class="inline-block" type="text" name="id_equipamento" placeholder="ID do equipamento" disabled />
                <input class="inline-block" type="text" name="nome_equipamento" placeholder="Nome do equipamento" required />
                <input class="inline-block" type="button" name="pesquisar_equipamento" value="Pesquisar" />
            </div>

            <!-- TODO: Div que mostra todos os equipamentos da solicitação -->

            <!-- Descrição do Problema -->
            <div>
                <label class="block" for="descricao_problema">Se quiser, descreva o problema</label>
                <textarea name="descricao_problema" rows="20" cols="50">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</textarea>
            </div>

            <!--
                <p>Estado</p>
                <input type="text" name="" placeholder="Em andamento"><br>                
                -->

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