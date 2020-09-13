<?php
session_start();

require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";
require_once "../../model/Solicitacao.php";
require_once "../../model/Equipamento.php";

print "inicio<br>";
var_dump($_POST);
print "<br>";

$url = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/cadastro.php?";

if (isset($_POST['submit'])) {
    // Tratamento de erros
    print "submitou<br>";
    if (!isset($_POST['id_usuario'])) {
        print "id_usuario não informado<br>";
        $url .= "id_usuario=0&";
    }
    if (!isset($_POST['descricao_problema'])) {
        print "descricao problema não informado<br>";
        $url .= "descricao_problema=0&";
    }

    // Dados do POST    
    print "coletando POST<br>";
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
    var_dump($idsEquipamentos);
    print "<br>";

    // Gerando o objeto Solicitação
    print "gerando solicitacao<br>";
    $solicitacao = new Solicitacao(null, $idUsuario, 1, $descricaoProblema, null);

    // Inserção da solicitação
    print "inserindo solicitacao<br>";
    $linhasAfetadas = $solicitacao->inserir($idsEquipamentos);
    if ($linhasAfetadas == 0) {
        print "deu errado a inserção<br>";
        $url .= "insert=0&";
    } else {
        print "deu certo a inserção<br>";
        $url .= "insert=1&";
    }
}
?>
<script type="text/javascript">
    location.href = '<?php print $url; ?>';
</script>