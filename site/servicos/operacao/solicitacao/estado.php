<?php

// Import da classe Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a model de Setor
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Solicitacao.php";

// URL para redirecionamento
$urlRedirecionamento = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/pesquisa.php?";

$dadosValidos = true;

// Checa se o GET de id_solicitacao foi recebido
if (!isset($_GET['id_solicitacao'])) {
    $dadosValidos = false;
    $urlRedirecionamento .= "id_solicitacao_informado=0&";
}

// Checa se o GET de novo_estado foi recebido
if (!isset($_GET['novo_estado'])) {
    // Se a chave GET 'novo_estado' NÃO existe, dizer que ela não foi informada na URL
    $dadosValidos = false;
    $urlRedirecionamento .= "ativo_informado=0&";
}

// Checa se os dados são válidos
if ($dadosValidos) {
    // Se os dados SÃO váildos

    // Atribui os valores do GET
    $idSolicitacao = $_GET['id_solicitacao'];
    $novoEstado = $_GET['novo_estado'];

    // Tenta alterar o campo 'ativo' da tabela setor
    $resultado = (new Solicitacao($idSolicitacao, null, $novoEstado, null, null))->alterarEstado();

    // Checa se a chave que retornou foi 'erro'
    if (isset($resultado['erro'])) {
        // Se sim, retorne o erro        
        $urlRedirecionamento .= "alterado=0";
    }
    // Senão, checa se a chave que retornou foi sucesso
    elseif (isset($resultado['sucesso'])) {
        $urlRedirecionamento .= "alterado=1";
    }
}
?>

<!-- JavaScript -->

<script type="text/javascript">
    location.href = '<?php print $urlRedirecionamento; ?>';
</script>