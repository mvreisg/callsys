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
    <title>CallSYS - Cadastrar Usuário</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Cadastrar Usuário</h1>
        <?php

        ?>
        <form name="form_cadastro_usuario" action="../../../servicos/cadastro/usuario/cadastro.php" method="post">
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
                <label class="block" for="nome_setor">Setor</label>
                <!-- required temporário -->
                <input class="inline-block" type="text" name="id_setor" placeholder="ID" required />
                <!-- disable temporário -->
                <input class="inline-block" type="text" name="nome_setor" placeholder="Nome" disabled />
                <input class="inline-block" type="button" name="pesquisar_setor" value="Pesquisar" />
            </div>

            <!-- Função -->
            <div>
                <label class="block" for="nome_funcao">Função</label>
                <!-- required temporário -->
                <input class="inline-block" type="text" name="id_funcao" placeholder="ID" required />
                <!-- disable temporário -->
                <input class="inline-block" type="text" name="nome_funcao" placeholder="Nome" disabled />
                <input class="inline-block" type="button" name="pesquisar_funcao" value="Pesquisar" />
            </div>

            <!-- Nível de Acesso -->
            <div>
                <label class="block" for="nome_nivel_acesso">Nível de Acesso</label>
                <!-- required temporário -->
                <input class="inline-block" type="text" name="id_nivel_acesso" placeholder="ID" required />
                <!-- disable temporário -->
                <input class="inline-block" type="text" name="nome_nivel_acesso" placeholder="Nome" disabled />
                <input class="inline-block" type="button" name="pesquisar_nivel_acesso" value="Pesquisar" />
            </div>

            <!-- Ativo -->
            <div>
                <label class="inline-block" for="ativo">Ativo</label>
                <input class="inline-block" type="checkbox" name="ativo">
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