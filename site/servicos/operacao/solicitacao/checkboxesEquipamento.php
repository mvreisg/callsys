<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Equipamento.php";

$resultado = (new Equipamento(null, null, null, null))->consultarTodos();

if (isset($resultado['equipamentos'])) {
    $equipamentos = $resultado['equipamentos'];

    foreach ($equipamentos as $equipamento) {
        print "<div class='block'>";
        print "<input class='inline-block' type='checkbox' name='equipamento{$equipamento->getId()}' value='{$equipamento->getId()}'/>";
        print "<label class='inline-block' for='{$equipamento->getId()}'/>{$equipamento->getNome()}</label>";
        print "</div>";
    }
}
