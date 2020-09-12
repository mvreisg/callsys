<?php
session_start();

require_once "../../request/Request.php";
require_once "../../model/Equipamento.php";

if (isset($_POST['confirmar'])) {
    // Parametros do POST
    $nome = "";
    $ativo = 0;
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
    }
    if (isset($_POST['ativo'])) {
        $ativo = $_POST['ativo'];
    }
    $equipamento = new Equipamento(
        null,
        $nome,
        $ativo ? 1 : 0,
        null
    );
    var_dump($equipamento);
    $linhasAfetadas = $equipamento->inserir();

    $url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/equipamento/cadastro.php?";
    if ($linhasAfetadas > 0) {
        $url .= "insert=sucesso";
    } else {
        $url .= "insert=falha";
    }
}
?>
<script type="text/javascript">
    location.href = '<?php print $url; ?>';
</script>