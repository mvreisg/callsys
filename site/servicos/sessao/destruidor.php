<?php 
    if (isset($_SESSION['estaLogado'])){
        session_destroy();
        $_SESSION = array();
        
        $scriptDestruidorRedirecionadorPaginaLogin = "<script>location.replace('https://" . $_SERVER['SERVER_NAME'] . "/paginas/login.php');</script>";
        print($scriptDestruidorRedirecionadorPaginaLogin);              
    }   
?>