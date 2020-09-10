<?php 
    session_start();        
    
    // Importa o arquivo que checa se há login
    require_once "../login/temLogin.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="../../estilos/fontes.css"/>
        <link rel="stylesheet" type="text/css" href="../../estilos/interno.css"/>        
        <meta charset="utf-8"/>
        <title>Início</title>        
    </head>
    <body>              
        <nav>
            <?php 
                require_once "nav.php";
            ?>
        </nav>        
        <section>
            <h1>Bem-vindo ao Sistema!</h1>            
        </section>
        <footer>
            <p>Versão do sistema: Demo alpha 0.1</p>
        </footer>          
    </body>
</html>