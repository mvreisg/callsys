<?php

// Importa a model de Setor
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Setor.php";

// Realiza a consulta de todos os setores e captura o resultado
$resultado = (new Setor(null, null, null))->consultarTodos();



// Checa se a chave recebida é 'setores'
if (isset($resultado['setores'])) {
    // Se sim, recebe todos os objetos Setor
    $setores = $resultado['setores'];

    // Percorre o array de setores expondo cada setor
    foreach ($setores as $setor) {
        // URL para ativação / inativação
        $urlAtivo = "{$_SERVER['SERVER_NAME']}/estagio/site/servicos/operacao/setor/ativo.php?setAtivo=" . !$setor->getAtivo() . "&";

        // Pega o valor para saber se está ativo para dar a propriedade 'checked' para o 'input'
        $checked = $setor->getAtivo() ? "checked" : "";
        print "<tr>";
        print "<td><input type='checkbox' $checked onclick=\"ativo('$urlAtivo');\"/></td>";
        print "<td>{$setor->getId()}</td>";
        print "<td>{$setor->getNome()}</td>";
        print "<td><button onclick=\"alert('editar');\">Editar</button></td>";
        print "</tr>";
    }
}
