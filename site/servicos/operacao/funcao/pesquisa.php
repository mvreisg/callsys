<?php

// Importa a classe Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a model de Funcao
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Funcao.php";

// Realiza a consulta de todos as funções e captura o resultado
$resultado = (new Funcao(null, null, null))->consultarTodos();

// Checa se a chave recebida é 'funcoes'
if (isset($resultado['funcoes'])) {
    // Se sim, recebe todos os objetos funcao
    $funcoes = $resultado['funcoes'];

    // Percorre o array de funcoes expondo cada funcao
    foreach ($funcoes as $funcao) {
        // URL para ativação / inativação
        $urlAtivo  = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/servicos/operacao/funcao/ativo.php?";
        $urlAtivo .= "id_funcao=" . $funcao->getId() . "&novo_ativo=" . ($funcao->getAtivo() ? 0 : 1);

        // Pega o valor para saber se está ativo para dar a propriedade 'checked' para o 'input'
        $checked = $funcao->getAtivo() ? "checked" : "";
        print "<tr>";
        print "<td><input type='checkbox' $checked onclick=\"redirecionarParaAtivo('$urlAtivo');\"/></td>";
        print "<td>{$funcao->getId()}</td>";
        print "<td>{$funcao->getNome()}</td>";
        print "<td><button onclick=\"alert('editar');\">Editar</button></td>";
        print "</tr>";
    }
}
