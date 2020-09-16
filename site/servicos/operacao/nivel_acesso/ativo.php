<?php

// Import da classe Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a model de NivelAcesso
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/NivelAcesso.php";

// URL para redirecionamento
$urlRedirecionamento = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/nivel_acesso/pesquisa.php?";

$dadosValidos = true;

// Checa se o GET de id_nivel_acesso foi recebido
if (!isset($_GET['id_nivel_acesso'])) {
    $dadosValidos = false;
    $urlRedirecionamento .= "id_nivel_acesso_informado=0&";
}

// Checa se o GET de novo_ativo foi recebido
if (!isset($_GET['novo_ativo'])) {
    // Se a chave GET 'novo_ativo' NÃO existe, dizer que ela não foi informada na URL
    $dadosValidos = false;
    $urlRedirecionamento .= "ativo_informado=0&";
}

// Checa se os dados são válidos
if ($dadosValidos) {
    // Se os dados SÃO váildos

    // Atribui os valores do GET
    $idFuncao = $_GET['id_nivel_acesso'];
    $novoAtivo = $_GET['novo_ativo'];

    // Tenta alterar o campo 'ativo' da tabela funcao
    $resultado = (new NivelAcesso($idFuncao, null, $novoAtivo))->alterarAtivo();

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