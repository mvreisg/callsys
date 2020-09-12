<?php
session_start();

require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../model/Funcao.php";

if (isset($_POST['confirmar'])) {
    // Objeto Equipamento
    $funcao = null;

    // Parâmetros do POST
    $nome = "";
    $ativo = false;
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
    }
    if (isset($_POST['ativo'])) {
        $ativo = $_POST['ativo'];
    }
    $funcao = new Funcao(
        null,
        $nome,
        $ativo ? 1 : 0
    );
    $linhasAfetadas = $funcao->inserir();
}
?>
<script>
    location.href = '<?php
                        if ($linhasAfetadas > 0) {
                            print Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/funcao/cadastro.php?insert=sucesso";
                        }
                        ?>';
</script>