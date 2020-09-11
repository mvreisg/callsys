<?php 
    session_start();        
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="../../../estilos/fontes.css"/>
        <link rel="stylesheet" type="text/css" href="../../../estilos/geral.css"/>
        <link rel="stylesheet" type="text/css" href="../../../estilos/interno.css"/>
        <link rel="stylesheet" type="text/css" href="../../../estilos/cadastro.css"/>     
        <meta charset="utf-8"/>
        <title>CallSYS - Cadastrar Função</title>        
    </head>
    <body>              
        <nav>
            <?php require_once "../nav.php"; ?>
        </nav> 
        <section>            
            <h1>Cadastrar Função</h1>
            <?php                 
                // TODO: invalidar GET após recebimento
                if (isset($_GET['insert'])){
                    switch($_GET['insert']){
                        case "sucesso":
                            print "<p style='color: green;'>Função cadastrado com sucesso</p>";                                                
                        break;
                        case "falha":
                            print "<p style='color: red;'>Falha ao inserir a função</p>";                                                
                        break;
                    }                             
                }
            ?>
            <form name="form_cadastro_funcao" action="../../../servicos/cadastro/funcao/cadastro.php" method="post">
                <!-- Nome -->
                <div>
                    <label class="block" for="nome">Nome</label>
                    <input type="text" name="nome" required/>
                </div>

                <!-- Ativo -->
                <div>
                    <label for="ativo">Ativo</label>
                    <input type="checkbox" name="ativo">
                </div>

                <!-- Ações -->                
                <div>
                    <!-- Confirmar -->                
                    <input class="inline-block" type="submit" name="confirmar" value="Confirmar">

                    <!-- Cancelar -->
                    <input class="inline-block" type="button" name="cancelar" value="Cancelar">

                    <!-- Limpar -->
                    <input class="inline-block" type="button" name="limpar" value="Limpar">
                </div>
            </form>
        </section>
        <footer>
            <?php require_once "../footer.php"; ?>
        </footer>
    </body>
</html>
<?php
    require_once "../../../servicos/login/verificarLogin.php";
?>