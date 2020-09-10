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
        <title>CallSYS - Operações - Usuário</title>        
    </head>
    <body>              
        <nav>
            <?php require_once "../nav.php"; ?>
        </nav> 
        <section>
            <h1 style=" color: black">Cadastrar Usuarios</h1>
            <form>
                <p>Nome</p>
                <input type="text" name="" >
                <p>Usuario</p>
                <input type="text" name="">
                <p>Senha</p>
                <input type="text" name=""><br>

                <label for="funcao">Função:</label>
                <select name="funcao" id="funcao">
                  <option value="enf">Enfermeiro</option>
                  <option value="adm">Adiministrativo</option>
                  <option value="medico">Medico</option>
                </select><br>

                <label for="setor">Setor:</label>
                <select name="setor" id="setor">
                  <option value="amb">ambulatorio</option>
                  <option value="adm">Adiministrativo</option>
                  <option value="ti">tecnologia da informação</option>
                </select><br>

                <label for="nvlacess">Nivel de acesso:</label>
                <select name="funcao" id="funcao">
                  <option value="user">usuario</option>
                  <option value="supervisor">Supervisor</option>
                  <option value="TI">Ti</option>
                </select><br>
               
                <input type="checkbox" name="ativo">
                <label for="ativo">Ativo</label>
                <input type="submit" name="" value="Confirmar">
                <input type="submit" name="" value="Cancelar">
            </form>
        </section>
        <footer>
            <?php require_once "../footer.php"; ?>
        </footer>
    </body>
</html>