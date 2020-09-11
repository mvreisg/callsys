<?php 
    session_start();
        
    require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";     
    require_once "Setor.php";

    $prefixoURL = Request::PREFIXO_URL;

    if (isset($_POST['confirmar'])){
        // Objeto Equipamento
        $setor = null;

        // Parâmetros do POST
        $nome = "";
        $ativo = false;
        if (isset($_POST['nome'])){
            $nome = $_POST['nome'];                        
        }        
        if (isset($_POST['ativo'])){
            $ativo = $_POST['ativo'];
        }
        print "ativo: $ativo";
        print "<br>";
        $setor = new Setor(
            null,
            $nome,
            $ativo ? 1 : 0            
        );
        //var_dump($equipamento);
        $linhasAfetadas = $setor->inserir();
        print "$linhasAfetadas linha(s) afetadas";
    }
?>
<script>        
    var urlRedirecionamento = 
    '<?php     
        if ($linhasAfetadas > 0) {            
            print "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/cadastro.php?insert=sucesso";
        }
    ?>';
    location.href = urlRedirecionamento;
</script>