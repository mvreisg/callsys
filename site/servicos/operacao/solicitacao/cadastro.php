<?php
session_start();

require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../model/Solicitacao.php";
require_once "../../model/Equipamento.php";

$url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/cadastro.php?";

var_dump($_POST);
print "<br>";

if (isset($_POST['submit'])) {
    // Tratamento de erros
    if (!isset($_POST['id_usuario'])) {
        $url .= "id_usuario=0&";
    }
    if (!isset($_POST['descricao_problema'])) {
        $url .= "descricao_problema=0&";
    }

    // Dados do POST    
    $idUsuario = $_POST['id_usuario'];
    $descricaoProblema = $_POST['descricao_problema'];
    $idsEquipamentos = array();

    // Filtro dos options dos equipamentos
    foreach ($_POST as $index => $valor) {
        // Se achar a string "equipamento" no parametro POST da option do Equipamento                
        // $index = "equipamento0000000001",         
        //  |-> "equipamento" é o filtro
        //  |-> "0000000001" é o ID (valor necessário)        
        // $valor = "0000000001"

        // Se encontrar a string "equipamento" no index
        if (strpos($index, "equipamento") === 0) {
            // Pegar seu valor e armazenar
            $idsEquipamentos[] = $valor;
        }
    }

    // Gerando o objeto Solicitação
    $solicitacao = new Solicitacao(null, $idUsuario, 1, $descricaoProblema, null);

    // Inserção da solicitação    
    $resultado = $solicitacao->inserir($idsEquipamentos);
    var_dump($resultado);

    $url .= "insert=" . array_keys($resultado)[0] . "&";
}
?>
<script type="text/javascript">
    location.href = '<?php print $url; ?>';
</script>