<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/NivelAcesso.php";

$resultado = (new NivelAcesso(null, null, null))->consultarTodos();

if (isset($resultado['niveis_acesso'])) {
    $niveisAcesso = $resultado['niveis_acesso'];

    foreach ($niveisAcesso as $nivelAcesso) {
        print "<option value='{$nivelAcesso->getId()}'>{$nivelAcesso->getNome()}</option>";
    }
}
