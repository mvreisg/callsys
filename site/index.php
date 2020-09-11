<?php     
    session_start();      

    // Checa se há registro de login
    if (isset($_SESSION['logado'])){        
        // Senão, checa se está logado
        if ($_SESSION['logado']){        
            // Se sim
            // Zera toda a sessão
            session_unset();

            // Destrói a sessão
            session_destroy();  
            
            // Inicia a sessão novamente
            session_start();
        }   
    }    
    // Diz que não está logado para a sessão 
    $_SESSION['logado'] = false;
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="estilos/fontes.css"/>
        <link rel="stylesheet" type="text/css" href="estilos/geral.css"/>                
        <link rel="stylesheet" type="text/css" href="estilos/index.css"/>                        
        <meta charset="utf-8"/>
        <title>CallSYS - Login</title>
    </head>        
    <body>            
        <div class="login">
            <h1>
                CallSYS
            </h1>
            <?php
                // Recebe o GET para ver se o login for invalidado
                $loginInvalido = false;
                if (isset($_GET['loginInvalido'])){
                    $loginInvalido = $_GET['loginInvalido'];
                }
                
                if ($loginInvalido){
                    // TODO: fazer em JavaScript
                    print "<p style='color: red; margin: 4px 0px;'>";
                    print "Login e/ou senha inválidos!";
                    print "</p>";
                }
            ?>
            <form name="form_autenticacao" action="servicos/login/realizarLogin.php" method="post">                                
                <!-- Usuario -->
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" maxlength="10" placeholder="Insira seu usuário" required/>                

                <!-- Senha -->
                <label for="senha">Senha</label>
                <input type="password" name="senha" maxlength="10" placeholder="Insira sua senha" required/>
                
                <!-- Ações -->                
                <input type="submit" name="logar" value="Login"/>                

                <!-- TODO: Implementar? -->
                <a href="#">Esqueceu sua senha?</a>
            </form>
        </div>
    </body>
</html>   