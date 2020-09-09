<?php              
    //importa a sessao
    include_once("inicializador.php");   

    //importa o pdo
    include_once("../conexao/pdo.php");

    //checa a autenticação sempre que chegar na pagina de login
    //pra ver se está logado mesmo
    if (isset($_POST["usuario"]) && isset($_POST["senha"])){        
        $usuarioPOST = $_POST["usuario"];
        $senhaPOST = $_POST["senha"];                          
        $_SESSION['submitouFormAutenticacao'] = true; 

        try{            
            //consulta no banco se o usuario existe
            $select = "select * from usuario where usuario = '" . $usuarioPOST . "' and senha = '" . $senhaPOST . "';";
            $query = $pdo->query($select);                                     
            //retorna a quantidade de linhas encontradas
            $quantidadeLinhas = $query->rowCount();
            $_SESSION['temAutenticacao'] = $quantidadeLinhas >= 1;            
        } 
        catch (PDOException $e){
            print($e);
        }                                    
    }    
    print("<p>autenticado: {$_SESSION['temAutenticacao']}</p>");

    if ($_SESSION['temAutenticacao']){
        //está cadastrado e autenticado, logo pode entrar no site
        $_SESSION['estaLogado'] = true;                    
        //redirecionamento para a pagina principal        
        print("<script>");
        print("location.replace('http://{$_SERVER['SERVER_NAME']}/estagio/site/interno/principal.php');");
        print("</script>");        
    }
    else{
        //retorno para a página de login                
        print("<script>");
        print("location.replace('http://{$_SERVER['SERVER_NAME']}/estagio/site/');");
        print("</script>");        
    }