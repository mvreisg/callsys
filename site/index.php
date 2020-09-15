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
    <link rel="stylesheet" type="text/css" href="estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="estilos/index/index.css" />
    <meta charset="utf-8" />
    <title>CallSYS - Login</title>
    <style type="text/css">

    </style>
</head>

<body>
    <div id="login">
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