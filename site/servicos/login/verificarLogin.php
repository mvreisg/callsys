<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Checa se há login
$existeLogin;
if ($_SESSION['logado']) {
    $existeLogin = true;
} else {
    $existeLogin = false;
}
?>
<script type="text/javascript">
    var logado = <?php print $existeLogin ? 1 : 0; ?>;
    //alert('logado: ' + logado);
    if (logado == 0) {
        location.href = '<?php print Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/index.php" ?>';
    }
</script>