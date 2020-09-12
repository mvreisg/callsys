<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Equipamento.php";

$equipamentos = (new Equipamento(null, null, null, null))->consultarTodos();

foreach ($equipamentos as $equipamento) {
    print "<option value='{$equipamento['id']}'>{$equipamento['nome']}</option>";
}
