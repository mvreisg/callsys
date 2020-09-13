<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Usuario.php";

$usuarios = (new Usuario(null, null, null, null, null, null, null, null))->consultarTodos();

foreach ($usuarios as $usuario) {
    print "<option value='{$usuario['id']}'>{$usuario['nome']}</option>";
}
