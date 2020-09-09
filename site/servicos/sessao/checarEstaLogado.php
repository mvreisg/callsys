<?php     
    if (!isset($_SESSION['estaLogado'])){        
        print("<script>");
        print("location.replace('http://{$_SERVER['SERVER_NAME']}/estagio/site/');");
        print("</script>");  
    }   