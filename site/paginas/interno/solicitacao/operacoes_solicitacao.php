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
        <title>CallSYS - Operações - Solicitação</title>        
    </head>
    <body>              
        <nav>
            <?php require_once "../nav.php"; ?>
        </nav> 
        <section>
            <h1 style="color: black">Solicitações</h1>
            <form>
                <p>Nome</p>
                <input type="text" name="" >
                <p>Setor</p>
                <input type="text" name=""><br>

                <label for="equipamentos">Equipamentos:</label>
                <select name="equipamentos" id="equipamentos">
                  <option value="cpu">Cpu</option>
                  <option value="mouse">Mouse</option>
                  <option value="Tela">Tela</option>
                </select><br>

                <label for="descricao">Descrição do problema:</label>
                <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea> 
                <p>Estado</p>
                <input type="text" name="" placeholder="Em andamento"><br>
                <input type="submit" name="" value="Confirmar">
                <input type="submit" name="" value="Cancelar">
            </form>
        </section>
        <footer>
            <?php require_once "../footer.php"; ?>
        </footer>
    </body>
</html>