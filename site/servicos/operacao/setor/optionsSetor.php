<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Setor.php";

$setores = (new Setor(null, null, null))->consultarTodos();

foreach ($setores as $setor) {
    print "<option value='{$setor['id']}'>{$setor['nome']}</option>";
}
