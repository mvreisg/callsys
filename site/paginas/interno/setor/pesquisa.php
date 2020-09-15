<?php
session_start();

// Importa a classe de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Verifica se há login
require_once "../../../servicos/login/verificarLogin.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/interno.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/setor/pesquisa.css" />
    <meta charset="utf-8" />
    <title>CallSYS - Setores</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Pesquisa de Setor</h1>
        <div id="div-pesquisa">
            <form name="form_pesquisa" action="" method="POST">
                <input name="input_pesquisa" type="text" placeholder="Nome" />
                <input name="button_pesquisa" type="submit" value="Lupa" />
            </form>
        </div>
        <div id="div-cadastro">
            <button onclick="">Cadastrar</button>
        </div>
        <div id="div-setores">
            <table>
                <tr>
                    <th>
                        Ativo
                    </th>
                    <th>
                        ID
                    </th>
                    <th>
                        Nome
                    </th>
                    <th>
                        Ações
                    </th>
                </tr>
                <tr>
                    <!-- TODO: Gerar via PHP -->
                    <td>
                        <input type="checkbox" />
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        Administrativo
                    </td>
                    <td>
                        <button onclick="">Editar</button>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
</body>

</html>