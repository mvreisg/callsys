<?php     
    // Checa se o usuário está logado
    $logado;
    if (!isset($_SESSION['logado'])){        
        $logado = $_SESSION['logado'];
    }
    else{
        $logado = false;
    }

    // Se não está logado retorna ele para a tela de login
    if (!$logado){        
        // Zera toda a sessão
        session_unset();

        // Destrói a sessão
        session_destroy();
    }   

