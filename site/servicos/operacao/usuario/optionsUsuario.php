<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Usuario.php";

$resultado = (new Usuario(null, null, null, null, null, null, null, null))->consultarTodos();

if (isset($resultado['usuarios'])) {
    $usuarios = $resultado['usuarios'];

    foreach ($usuarios as $usuario) {
        print "<option value='{$usuario->getID()}'>{$usuario->getNome()}</option>";
    }
}
