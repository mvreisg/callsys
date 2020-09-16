<?php

// Importa a classe Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a model de NivelAcesso
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/NivelAcesso.php";

// Realiza a consulta de todos as funções e captura o resultado
$resultado = (new NivelAcesso(null, null, null))->consultarTodos();

// Checa se a chave recebida é 'niveis_acesso'
if (isset($resultado['niveis_acesso'])) {
    // Se sim, recebe todos os objetos nivel_acesso
    $niveisAcesso = $resultado['niveis_acesso'];

    // Percorre o array de niveis_acesso expondo cada nivel_acesso
    foreach ($niveisAcesso as $nivelAcesso) {
        // URL para ativação / inativação
        $urlAtivo  = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/servicos/operacao/nivel_acesso/ativo.php?";
        $urlAtivo .= "id_nivel_acesso=" . $nivelAcesso->getId() . "&novo_ativo=" . ($nivelAcesso->getAtivo() ? 0 : 1);

        // Pega o valor para saber se está ativo para dar a propriedade 'checked' para o 'input'
        $checked = $nivelAcesso->getAtivo() ? "checked" : "";
        print "<tr>";
        print "<td><input type='checkbox' $checked onclick=\"redirecionarParaAtivo('$urlAtivo');\"/></td>";
        print "<td>{$nivelAcesso->getId()}</td>";
        print "<td>{$nivelAcesso->getNome()}</td>";
        print "<td><button onclick=\"alert('editar');\">Editar</button></td>";
        print "</tr>";
    }
}
