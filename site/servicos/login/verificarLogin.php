<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Checa se há login
$existeLogin;
if ($_SESSION['login']) {
    $existeLogin = true;
} else {
    $existeLogin = false;
}
?>
<script type="text/javascript">
    var login = <?php print $existeLogin ? 1 : 0; ?>;
    //alert('logado: ' + logado);
    if (!login) {
        location.href = '<?php print Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/index.php" ?>';
    }
</script>