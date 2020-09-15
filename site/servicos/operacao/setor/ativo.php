<?php

// Importa a model de Setor
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Setor.php";

// URL para redirecionamento
$urlRedirecionamento = "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/pesquisa.php?";

// Checa se o GET de setAtivo foi recebido
if (!isset($_GET['setAtivo'])) {
    // Se a chave 'setAtivo' NÃO existe
    $urlRedirecionamento .= "alterado=0";
} else if ($_GET['setAtivo']) {
    // Senão se existe e está ativo

    // Edita o valor do setor no banco

}
