<?php     
    session_start();      
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="estilos/index.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet"/>
        <meta charset="utf-8"/>
        <title>CallSYS</title>
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
            <form name="form_autenticacao" action="paginas/login/realizarLogin.php" method="post">                                
                <label for="usuario">
                    Usuario
                </label>
                <input type="text" name="usuario" maxlength="10" placeholder="Insira seu usuario" required/>                

                <label for="senha">
                    Senha
                </label>
                <input type="password" name="senha" maxlength="10" placeholder="Insira sua senha" required/>

                <input type="submit" name="submitLogin" value="Login"/>                

                <a href="#">Esqueceu sua senha?</a>  
            </form>
        </div>
    </body>
</html>   