<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Relação de Título e LINKS
$items = array(
    "CallSYS"         => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/inicio.php",
    "Solicitação"     => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/pesquisa.php",
    "Usuário"         => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/pesquisa.php",
    "Equipamento"     => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/equipamento/pesquisa.php",
    "Setor"           => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/pesquisa.php",
    "Função"          => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/pesquisa.php",
    "Nível de Acesso" => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/nivel_acesso/pesquisa.php",
    "Sair"            => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/index.php",
);

// Corpo HTML    
foreach ($items as $titulo => $link) {
    print "<a href='$link'>$titulo</a>";
}
