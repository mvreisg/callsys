<?php
session_start();

require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../model/Solicitacao.php";
require_once "../../model/Equipamento.php";

if (isset($_POST['solicitar'])) {
    // Dados do POST
    $postIdUsuario = 0;
    $postIdEquipamentos = array();
    $postDescricaoProblema = "";
    if (isset($POST['usuario'])) {
        $postIdUsuario = $POST['usuario'];
    }
    if (isset($_POST['descricao_problema'])) {
        $postDescricaoProblema = $_POST['descricao_problema'];
    }
    foreach ($_POST as $chave => $valor) {
        $resultado = strpos($chave, "equipamento");
        if ($resultado === 0) {
            $postIdEquipamentos[] = substr($chave, strlen("equipamento"));
        }
    }
    //var_dump($postIdEquipamentos);
    // Processo de inserção
    $url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/cadastro.php";
    $solicitacao = new Solicitacao(null, $postIdUsuario, 1, $postDescricaoProblema, null);
    $equipamentos = array();
    foreach ($postIdEquipamentos as $postChaveIdEquipamento => $postValorIdEquipamento) {
        $equipamento = new Equipamento($postValorIdEquipamento, null, null, null);
        if ($equipamento->existe()){
            
        }
        $equipamentos[] = 
    }
    $solicitacao->inserir();
}
?>
<script type="text/javascript">
    //location.href = '<?php print $url; ?>';
</script>