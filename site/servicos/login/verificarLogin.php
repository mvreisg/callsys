<?php 
    require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

    $prefixoURL = Request::PREFIXO_URL;
?>
<script type="text/javascript">    
    var logado = <?php     
        // Checa se há login
        if (!isset($_SESSION['logado'])){
            print false;
        }        
        elseif ($_SESSION['logado']){                    
            print true;
        }                   
        else{
            print false;
        }                 
    ?>;
    //alert('logado: ' + logado);    
    if (logado == 0){        
        location.href = '<?php print "$prefixoURL{$_SERVER['SERVER_NAME']}/estagio/site/index.php" ?>';
    }
</script>

