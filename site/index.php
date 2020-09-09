<?php 
    //importa a sessao
    include_once("servicos/sessao/inicializador.php");
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="estilos/estilo_index.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet"/>
        <meta charset="utf-8"/>
        <title>CallSYS</title>
    </head>        
    <body>    
        <?php 
            //importa o destruidor de sessões
            include_once("servicos/sessao/destruidor.php");
        ?>            
        <div class="login">
            <h1>CallSYS</h1>
            <?php 
                if (isset($_SESSION['submitouFormAutenticacao']) && isset($_SESSION['temAutenticacao'])){                    
                    if ($_SESSION['submitouFormAutenticacao'] && !$_SESSION['temAutenticacao']){
                        //coloca como falso caso o usuário dê refresh na página 
                        //para o aviso não persistir
                        $_SESSION['submitouFormAutenticacao'] = false;

                        //printa a mensagem de credenciais inválidas
                        $mensagemLoginInvalido = "<p style='color: red; margin: 4px 0px;'>Login e/ou senha inválidos!</p>";           
                        print($mensagemLoginInvalido);                                  
                    }                    
                }                
            ?>
            <form name="form_autenticacao" action="sessao/autenticador.php" method="post">
                <!-- input hidden que contém o nome do form pra receber no post da autenticação -->
                <!-- <input type="hidden" name="form_autenticacao"/> -->
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" maxlength="10" placeholder="Insira seu usuario" required/>                
                <label for="senha">Senha</label>
                <input type="password" name="senha" maxlength="10" placeholder="Insira sua senha" required/>
                <input type="submit" name="submit" value="Login"/>                
                <a href="#">Esqueceu sua senha?</a>  
            </form>
        </div>
    </body>
</html>   