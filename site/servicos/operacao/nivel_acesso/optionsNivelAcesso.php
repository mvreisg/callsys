<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/NivelAcesso.php";

$niveisAcesso = (new NivelAcesso(null, null, null))->consultarTodos();

foreach ($niveisAcesso as $nivelAcesso) {
    print "<option value='{$nivelAcesso['id']}'>{$nivelAcesso['nome']}</option>";
}
