<?php
session_start();

// Checa se há a chave de login na sessão
if (isset($_SESSION['login'])) {
    // Se a chave de sessão existe
    if ($_SESSION['login']) {
        // Se existe e está logado,

        // Zera todas as variáveis da sessão
        session_unset();

        // Destrói a sessão
        session_destroy();

        // Inicia a sessão novamente
        session_start();
    }
}
// Atribui valor falso para a chave de login da nova sessão ou da existente,
// pois se o Usuário caiu na tela de login ele NÃO está logado
$_SESSION['login'] = false;
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="estilos/import_fontes.css" />
    <link rel="stylesheet" type="text/css" href="estilos/geral.css" />
    <meta charset="utf-8" />
    <title>CallSYS - Login</title>
    <style type="text/css">
        body {
            background-image: url(./imgs/login/background.jpg);
            background-size: cover;
            font-family: 'Comfortaa', sans-serif;
        }

        div {
            width: 320px;
            height: auto;
            border: 2px solid #000;
            border-radius: 80px 0px 80px 0px;
            color: #fff;
            background-color: rgba(0, 0, 5, 0.8);
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
            box-sizing: border-box;
            padding: 68px 28px;
        }

        div h1 {
            padding-bottom: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-align: center;
            font-size: 25px;
            color: #80ffff;
        }

        div p {
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        div input {
            width: 100%;
            margin-bottom: 21px;
        }

        div input[type="text"],
        input[type="password"] {
            border: none;
            border-bottom: 1px solid white;
            background-color: transparent;
            outline: none;
            height: 40px;
            color: white;
            font-size: 16px;
        }

        div input[type="submit"] {
            border: none;
            outline: none;
            height: 35px;
            color: #000;
            background: #fff;
            border-radius: 20px;
            transition: 0.2s;
        }

        div input[type="submit"]:hover {
            cursor: pointer;
            background: #80ffff;
            transition: 0.2s;
        }

        div a {
            font-weight: bold;
            text-decoration: none;
            font-size: 12px;
            line-height: 20px;
            color: #4b4b4b;
            transition: 0.2s;
        }

        div a:hover {
            transition: 0.2s;
            color: #ff4da6;
        }
    </style>
</head>

<body>
    <div>
        <h1>CallSYS</h1>
        <?php
        // Checa se o Usuario existe via GET
        if (isset($_GET['existe'])) {
            // Checa se o usuário existe
            if ($_GET['existe']) {
                // Se o usuário existe, checa se está ativo
                if (isset($_GET['ativo'])) {
                    // Checa se está ativo
                    if (!$_GET['ativo']) {
                        // Se não está ativo, informar se está ativo
                        print "<p style='color: red; margin: 4px 0px;'>Usuário inativo!</p>";
                    }
                }
            } else {
                // Senão, informar que o usuário não existe
                print "<p style='color: red; margin: 4px 0px;'>Usuário não cadastrado!</p>";
            }
        }
        ?>
        <form name="form_autenticacao" action="servicos/login/realizarLogin.php" method="post">
            <!-- Usuario -->
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" maxlength="10" placeholder="Insira seu usuário" required />

            <!-- Senha -->
            <label for="senha">Senha</label>
            <input type="password" name="senha" maxlength="10" placeholder="Insira sua senha" required />

            <!-- Ações -->
            <input type="submit" name="submitLogin" value="Login" />

            <!-- TODO: Implementar? -->
            <a href="#">Esqueceu sua senha?</a>
        </form>
    </div>
</body>

</html>