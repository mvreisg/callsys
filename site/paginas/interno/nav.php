<?php 
    // Relação de Título e LINKS
    $items = array(        
        "CallSYS"         => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/inicio.php",                
        "Solicitação"     => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/cadastro.php",
        "Usuário"         => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/cadastro.php",        
        "Equipamento"     => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/equipamento/cadastro.php",
        "Setor"           => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/cadastro.php",
        "Função"          => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/cadastro.php",
        "Nível de Acesso" => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/nivel_acesso/cadastro.php",
        "Sair"            => "http://{$_SERVER['SERVER_NAME']}/estagio/site/index.php",        
    );

    // Corpo HTML    
    foreach($items as $titulo => $link){
        print "<a href='$link'>$titulo</a>";
    }
?>