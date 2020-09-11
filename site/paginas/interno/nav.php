<?php 
    require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";    

    $prefixoURL = Request::PREFIXO_URL;

    // Relação de Título e LINKS
    $items = array(        
        "CallSYS"         => "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/inicio.php",                
        "Solicitação"     => "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/cadastro.php",
        "Usuário"         => "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/cadastro.php",        
        "Equipamento"     => "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/equipamento/cadastro.php",
        "Setor"           => "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/cadastro.php",
        "Função"          => "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/cadastro.php",
        "Nível de Acesso" => "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/nivel_acesso/cadastro.php",
        "Sair"            => "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/index.php",        
    );

    // Corpo HTML    
    foreach($items as $titulo => $link){
        print "<a href='$link'>$titulo</a>";
    }
?>