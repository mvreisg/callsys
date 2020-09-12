<?php
session_start();

require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "Login.php";

$podeLogar = false;
if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $login = new Login($_POST['usuario'], $_POST['senha']);
    $resultado = $login->login();
}

$url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}";
if ($resultado['existe'] && $resultado['ativo']) {
    $_SESSION['login'] = true;
    $url .= "/estagio/site/paginas/interno/inicio.php";
} else {
    $url .= "/estagio/site/index.php?existe={$resultado['existe']}&ativo={$resultado['ativo']}";
}
?>
<script type="text/javascript">
    //alert('<?php print $url; ?>');
    location.href = '<?php print $url; ?>';
</script>