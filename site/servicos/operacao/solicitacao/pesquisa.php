<?php

// Importa a classe Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a model de Solicitacao e SolicitacaoEquipamento
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Solicitacao.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/EquipamentoSolicitacao.php";

if ($pesquisarPorId) {
    $resultado = (new Solicitacao($id, null, null, null, null))->consultarPorId();
} else {
    // Realiza a consulta de todos as funções e captura o resultado
    $resultado = (new Solicitacao(null, null, null, null, null))->consultarTodos();
}

if (isset($resultado['solicitacao'])) {
    printarSolicitacao($resultado['solicitacao']);
}
// Checa se a chave recebida é 'solicitacoes'
elseif (isset($resultado['solicitacoes'])) {
    // Se sim, percorre o array de solicitacoes expondo cada solicitacao
    foreach ($resultado['solicitacoes'] as $solicitacao) {
        printarSolicitacao($solicitacao);
    }
}

function printarSolicitacao($solicitacao)
{
    $urlEstado  = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/servicos/operacao/solicitacao/estado.php?";
    $urlEstado .= "id_solicitacao=" . $solicitacao->getId() . "&";

    print "<tr>";
    print "<td>";
    print "<select id=\"estado" . (int)$solicitacao->getId() . "\">";
    print "<option value='1' " . ($solicitacao->getEstado() == 1 ? "selected" : "") . ">Realizada</option>";
    print "<option value='2' " . ($solicitacao->getEstado() == 2 ? "selected" : "") . ">Em andamento</option>";
    print "<option value='3' " . ($solicitacao->getEstado() == 3 ? "selected" : "") . ">Concluída</option>";
    print "</select>";
    // TODO: pegar o estado do option on onclick
    print "<button onclick=\"redirecionarParaEstado('$urlEstado', {$solicitacao->getId()})\">Alterar</td>";
    print "</td>";
    print "<td>{$solicitacao->getId()}</td>";
    print "<td>";

    $equipamentos = array();
    $resultado = (new EquipamentoSolicitacao(null, $solicitacao->getId(), null))->consultarTodosEquipamentosDaSolicitacao();
    if (isset($resultado['equipamentos'])) {
        $equipamentos = $resultado['equipamentos'];
    }
    //var_dump($resultado['equipamentos']);
    foreach ($equipamentos as $equipamento) {
        print "{$equipamento->getNome()}, ";
    }

    print "</td>";
    print "<td>{$solicitacao->getDescricaoProblema()}</td>";
    print "<td>{$solicitacao->getDataHoraSolicitacao()}</td>";
    print "<td><button onclick=\"alert('editar');\">Editar</button></td>";
    print "</tr>";
}
