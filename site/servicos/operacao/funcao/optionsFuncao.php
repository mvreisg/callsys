<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Funcao.php";

$resultado = (new Funcao(null, null, null))->consultarTodos();

if (isset($resultado['funcoes'])) {
    $funcoes = $resultado['funcoes'];

    foreach ($funcoes as $funcao) {
        print "<option value='{$funcao->getId()}'>{$funcao->getNome()}</option>";
    }
}
