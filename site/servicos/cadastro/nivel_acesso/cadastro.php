<?php
session_start();

require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "NivelAcesso.php";

if (isset($_POST['confirmar'])) {
    // Objeto Equipamento
    $nivelAcesso = null;

    // Parâmetros do POST
    $nome = "";
    $ativo = false;
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
    }
    if (isset($_POST['ativo'])) {
        $ativo = $_POST['ativo'];
    }
    $nivelAcesso = new NivelAcesso(
        null,
        $nome,
        $ativo ? 1 : 0
    );
    $linhasAfetadas = $nivelAcesso->inserir();
}
?>
<script>
    location.href = '<?php
                        if ($linhasAfetadas > 0) {
                            print Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/nivel_acesso/cadastro.php?insert=sucesso";
                        }
                        ?>';
</script>