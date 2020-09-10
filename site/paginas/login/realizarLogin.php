<?php              
    require_once "../../servicos/login/Login.php";    

    $podeLogar = false;    
    if (isset($_POST['usuario']) && isset($_POST['senha'])){                
        $login = new Login($_POST['usuario'], $_POST['senha']);
        $podeLogar = $login->logar();            
    }                
    
    $_SESSION['logado'] = $podeLogar;                        
?>
<script type="text/javascript">
    var urlRedirecionamento = 
    '<?php 
        $url = "http://{$_SERVER['SERVER_NAME']}";
        if ($_SESSION['logado']){
            $url .= "/estagio/site/paginas/principal.php";
        }
        else{
            $url .= "/estagio/site/index.php?loginInvalido=true";
        }
        print $url;                
    ?>';
    location.href = urlRedirecionamento;
</script>