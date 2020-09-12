<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Equipamento.php";

$equipamentos = (new Equipamento(null, null, null, null))->consultarTodos();

foreach ($equipamentos as $equipamento) {
    print "<div class='block'>";
    print "<input class='inline-block' type='checkbox' name='equipamento{$equipamento['id']}' value='{$equipamento['id']}'/>";
    print "<label class='inline-block' for='{$equipamento['id']}'/>{$equipamento['nome']}</label>";
    print "</div>";
}
