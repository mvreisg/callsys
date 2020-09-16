<?php

// Importa a classe Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a model de Equipamento
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Equipamento.php";

if ($pesquisarPorNome) {
    $resultado = (new Equipamento(null, $nome, null, null))->consultarPorNome();
} else {
    // Realiza a consulta de todos as funções e captura o resultado
    $resultado = (new Equipamento(null, null, null, null))->consultarTodos();
}


// Checa se a chave recebida é 'equipamentos'
if (isset($resultado['equipamentos'])) {
    // Se sim, recebe todos os objetos equipamento
    $equipamentos = $resultado['equipamentos'];

    // Percorre o array de equipamentos expondo cada equipamento
    foreach ($equipamentos as $equipamento) {
        // URL para ativação / inativação
        $urlAtivo  = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/servicos/operacao/equipamento/ativo.php?";
        $urlAtivo .= "id_equipamento=" . $equipamento->getId() . "&novo_ativo=" . ($equipamento->getAtivo() ? 0 : 1);

        // Pega o valor para saber se está ativo para dar a propriedade 'checked' para o 'input'
        $checked = $equipamento->getAtivo() ? "checked" : "";
        print "<tr>";
        print "<td><input type='checkbox' $checked onclick=\"redirecionarParaAtivo('$urlAtivo');\"/></td>";
        print "<td>{$equipamento->getId()}</td>";
        print "<td>{$equipamento->getNome()}</td>";
        print "<td>{$equipamento->getDataHoraCadastro()}</td>";
        print "<td><button onclick=\"alert('editar');\">Editar</button></td>";
        print "</tr>";
    }
}
