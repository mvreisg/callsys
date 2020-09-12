<?php
session_start();

require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../model/Usuario.php";

if (isset($_POST['confirmar'])) {
    // Parâmetros do POST
    $idSetor = 0;
    $idFuncao = 0;
    $idNivelAcesso = 0;
    $nome = "";
    $usuario = "";
    $senha = "";
    $ativo = false;
    if (isset($_POST['setor'])) {
        $idSetor = (int)$_POST['setor'];
    }
    if (isset($_POST['funcao'])) {
        $idFuncao = (int)$_POST['funcao'];
    }
    if (isset($_POST['nivel_acesso'])) {
        $idNivelAcesso = (int)$_POST['nivel_acesso'];
    }
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
    }
    if (isset($_POST['usuario'])) {
        $usuario = $_POST['usuario'];
    }
    if (isset($_POST['senha'])) {
        $senha = $_POST['senha'];
    }
    if (isset($_POST['ativo'])) {
        $ativo = $_POST['ativo'];
    }
    $usuario = new Usuario(
        null,
        $idSetor,
        $idFuncao,
        $idNivelAcesso,
        $nome,
        $usuario,
        $senha,
        $ativo ? 1 : 0
    );
    $linhasAfetadas = $usuario->inserir();
}
?>
<script>
    <?php
    $url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/cadastro.php";
    if ($linhasAfetadas > 0) {
        $url .= "?insert=sucesso";
    } else {
        $url .= "?insert=falha";
    }
    ?>
    location.href = '<?php print $url; ?>';
</script>