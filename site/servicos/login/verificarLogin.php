<script type="text/javascript">
    var logado = <?php     
        // Checa se há login
        if ($_SESSION['logado']){                    
            print 1;
        }                   
        else{
            print 0;
        }                 
    ?>;
    //alert('logado: ' + logado);
    if (logado == 0){
        location.href = <?php print "{$_SERVER['SERVER_NAME']}/estagio/site/index.php" ?>;
    }
</script>

