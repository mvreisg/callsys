<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../model/Solicitacao.php";
var_dump($_POST);
$url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/edicao.php?";
$ok = true;
if (!isset($_POST['id'])){
    $ok = false;
}
if (!isset($_POST['id_usuario'])){
    $ok = false;
}
if (!isset($_POST['descricao_problema'])){
    $ok = false;
}

if ($ok){
    $id = $_POST['id'];
    $idUsuario = $_POST['id_usuario'];
    $descricaoProblema = $_POST['descricao_problema'];

    $solicitacao = new Solicitacao($id, $idUsuario, null, $descricaoProblema, null);
    $resultado = $solicitacao->alterarPorId();
    if (isset($resultado['sucesso'])){
        $url .= "alterado=1&id={$id}";
    }
    else if (isset($resultado['erro'])){
        $url .= "alterado=0&id={$id}";
    }
}
else{
    $url .= "alterado=0&id={$id}";
}
?>
<script type="text/javascript">
    location.href = '<?php print $url; ?>';
</script>
