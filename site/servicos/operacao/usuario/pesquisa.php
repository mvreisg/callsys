<?php

// Importa a classe Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a model de Usuario
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Usuario.php";

if ($pesquisarPorNome) {
    $resultado = (new Usuario(null, null, null, null, $nome, null, null, null))->consultarPorNome();
} else {
    // Realiza a consulta de todos as funções e captura o resultado
    $resultado = (new Usuario(null, null, null, null, null, null, null, null))->consultarTodos();
}


// Checa se a chave recebida é 'usuarios'
if (isset($resultado['usuarios'])) {
    // Se sim, recebe todos os objetos usuario
    $usuarios = $resultado['usuarios'];

    // Percorre o array de usuarios expondo cada usuario
    foreach ($usuarios as $usuario) {
        // URL para ativação / inativação
        $urlAtivo  = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/servicos/operacao/usuario/ativo.php?";
        $urlAtivo .= "id_usuario=" . $usuario->getId() . "&novo_ativo=" . ($usuario->getAtivo() ? 0 : 1);

        // Pega o valor para saber se está ativo para dar a propriedade 'checked' para o 'input'
        $checked = $usuario->getAtivo() ? "checked" : "";
        print "<tr>";
        print "<td><input type='checkbox' $checked onclick=\"redirecionarParaAtivo('$urlAtivo');\"/></td>";
        print "<td>{$usuario->getId()}</td>";
        print "<td>{$usuario->getNome()}</td>";
        print "<td>{$usuario->getUsuario()}</td>";
        print "<td>{$usuario->getSenha()}</td>";
        print "<td>{$usuario->getIdSetor()}</td>";
        print "<td>{$usuario->getIdFuncao()}</td>";
        print "<td>{$usuario->getIdNivelAcesso()}</td>";
        print "<td><button onclick=\"alert('editar');\">Editar</button></td>";
        print "</tr>";
    }
}
