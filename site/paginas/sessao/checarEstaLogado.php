<?php     
    if (!isset($_SESSION['estaLogado'])){        
        $scriptCheckLogadoRedirecionadorPaginaLogin = "<script>location.replace('https://" . $_SERVER['SERVER_NAME'] . "/paginas/login.php');</script>";
        print($scriptCheckLogadoRedirecionadorPaginaLogin);              
    }   
?>