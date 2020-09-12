<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Funcao.php";

$funcoes = (new Funcao(null, null, null))->consultarTodos();

foreach ($funcoes as $funcao) {
    print "<option value='{$funcao['id']}'>{$funcao['nome']}</option>";
}
