<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Setor.php";

$setores = (new Setor(null, null, null))->consultarTodos()['setores'];

foreach ($setores as $setor) {
    print "<option value='" . $setor->getId() . "'>" . $setor->getNome() . "</option>";
}
