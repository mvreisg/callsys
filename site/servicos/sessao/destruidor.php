<?php 
    if (isset($_SESSION['estaLogado'])){
        session_destroy();
        $_SESSION = array();
        
        print("<script>");
        print("location.replace('http://{$_SERVER['SERVER_NAME']}/estagio/site/');");
        print("</script>");  
    }   