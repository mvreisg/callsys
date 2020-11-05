<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../model/Funcao.php";

$url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/edicao.php?";

$ok = true;
if (!isset($_POST['id'])){
    $ok = false;    
}
if (!isset($_POST['nome'])){
    $ok = false;    
}
$ativo = isset($_POST['ativo']);

if ($ok){
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $funcao = new Funcao($id, $nome, $ativo);
    $resultado = $funcao->alterarPorId();    
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
