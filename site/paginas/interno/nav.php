<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Relação de Título e LINKS
$items = array();

$items[] = array("CallSYS"     => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/inicio.php");
$items[] = array("Solicitação" => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/pesquisa.php");

if ($_SESSION['nivel_acesso'] == 1){
    $items[] = array("Usuário"         => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/pesquisa.php");
    $items[] = array("Equipamento"     => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/equipamento/pesquisa.php");
    $items[] = array("Setor"           => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/pesquisa.php");
    $items[] = array("Função"          => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/pesquisa.php");
    $items[] = array("Nível de Acesso" => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/nivel_acesso/pesquisa.php");
}

$items[] = array("Sair" => Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/index.php");

// Corpo HTML    
foreach ($items as $item) {
    foreach($item as $titulo => $link){
        print "<a href='$link'>$titulo</a>";
    }    
}
