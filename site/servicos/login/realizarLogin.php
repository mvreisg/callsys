<?php
session_start();

require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../servicos/login/Login.php";

$podeLogar = false;
if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $login = new Login($_POST['usuario'], $_POST['senha']);
    $linhasAfetadas = $login->login();
}

$_SESSION['logado'] = $linhasAfetadas > 0;
?>
<script type="text/javascript">
    var urlRedirecionamento =
        '<?php
            $url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}";
            if ($_SESSION['logado']) {
                $url .= "/estagio/site/paginas/interno/inicio.php";
            } else {
                $url .= "/estagio/site/index.php?loginInvalido=true";
            }
            print $url;
            ?>';
    location.href = urlRedirecionamento;
</script>