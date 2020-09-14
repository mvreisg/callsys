<?php
// Importa o arquivo de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

$temLogin;
// Checa se há chave de login na sessao
if (!isset($_SESSION['login'])) {
    // Se não existe a chave de login na sessao, não tem login
    $temLogin = false;
} else {
    // Senão, capture o valor da chave
    $temLogin = $_SESSION['login'];
}
?>

<!-- JavaScript -->
<script type="text/javascript">
    // Checa se há login
    if (!<?php print (int)$temLogin; ?>) {
        // Se não houver login, retorna para a página de login
        location.href = '<?php print Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/index.php" ?>';
    }
</script>