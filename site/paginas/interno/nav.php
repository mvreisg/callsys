<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Relação de Título e LINKS
$items = array(
    "CallSYS"         => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/inicio.php",
    "Solicitação"     => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/cadastro.php",
    "Usuário"         => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/cadastro.php",
    "Equipamento"     => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/equipamento/cadastro.php",
    "Setor"           => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/cadastro.php",
    "Função"          => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/cadastro.php",
    "Nível de Acesso" => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/nivel_acesso/cadastro.php",
    "Sair"            => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/index.php",
);

// Corpo HTML    
foreach ($items as $titulo => $link) {
    print "<a href='$link'>$titulo</a>";
}
