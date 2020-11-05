<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../model/Usuario.php";

$url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/edicao.php?";
$ok = true;
if (!isset($_POST['id'])){
    $ok = false;    
}
if (!isset($_POST['id_setor'])){
    $ok = false;    
}
if (!isset($_POST['id_funcao'])){
    $ok = false;    
}
if (!isset($_POST['id_nivel_acesso'])){
    $ok = false;    
}
if (!isset($_POST['nome'])){
    $ok = false;    
}
if (!isset($_POST['usuario'])){
    $ok = false;    
}
if (!isset($_POST['senha'])){
    $ok = false;    
}
$ativo = isset($_POST['ativo']);

if ($ok){
    $id = $_POST['id'];
    $idSetor = $_POST['id_setor'];
    $idFuncao = $_POST['id_funcao'];
    $idNivelAcesso = $_POST['id_nivel_acesso'];
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $usuarioModel = new Usuario($id, $idSetor, $idFuncao, $idNivelAcesso, $nome, $usuario, $senha, $ativo);
    $resultado = $usuarioModel->alterarPorId();    
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
