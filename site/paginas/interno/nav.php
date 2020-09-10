<?php 
    // Relação de Título e LINKS
    $items = array(        
        "Inicio"          => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/inicio.php",        
        "Solicitação"     => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/operacoes_solicitacao.php",
        "Usuário"         => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/operacoes_usuario.php",        
        "Equipamento"     => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/equipamento/operacoes_equipamento.php",
        "Setor"           => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/operacoes_setor.php",
        "Função"          => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/operacoes_funcao.php",
        "Nível de Acesso" => "http://{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/nivel_acesso/operacoes_nivel_acesso.php",
    );

    // Corpo HTML
    print "<h1>CallSYS</h1>";
    foreach($items as $titulo => $link){
        print "<a href='$link'>$titulo</a>";
    }
?>