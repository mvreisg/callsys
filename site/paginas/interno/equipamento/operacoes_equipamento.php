<?php 
    session_start();        
    
    // Importa o arquivo que checa se há login
    require_once "../../login/temLogin.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="../../../estilos/fontes.css"/>
        <link rel="stylesheet" type="text/css" href="../../../estilos/interno.css"/>        
        <meta charset="utf-8"/>
        <title>CallSYS - Operações - Equipamento</title>        
    </head>
    <body>              
        <nav>
            <?php require_once "../nav.php"; ?>
        </nav> 
        <section>
            <h1 style=" color: black">Operações de Equipamentos</h1>
            <form>                
                <p>Equipamentos</p>
                <input type="text" name="">
                <input type="checkbox" name="ativo">
                <label for="ativo">Ativo</label>
                <input type="submit" name="" value="Confirmar">
                <input type="reset" name="" value="Cancelar">
            </form>
        </section>
        <footer>
            <?php require_once "../footer.php"; ?>
        </footer>
    </body>
</html>