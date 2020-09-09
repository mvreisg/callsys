<?php 
    //importa a sessao
    include_once("../sessao/inicializador.php");
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="/estilos/estilo_principal.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet"/>
        <meta charset="utf-8"/>
        <title>Principal</title>
    </head>
    <body>
        <?php
            //inclui o checador de login para remover dessa página quem não estiver logado
            include_once("../sessao/checarEstaLogado.php");
        ?>
        <nav>
            <ul>
                <li>
                    <a>CallSYS</a>
                </li>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#">Solicitações</a>
                </li>
                <li>
                    <a href="#">Usuarios</a>
                </li>
                <li>
                    <a href="#">Equipamentos</a>
                </li>
            </ul>
        </nav>        
        <section>
            <h1>Bem-vindo ao Sistema!</h1>            
        </section>
        <footer>
            <p>Versão do sistema: Demo alpha 0.1</p>
        </footer>          
    </body>
</html>