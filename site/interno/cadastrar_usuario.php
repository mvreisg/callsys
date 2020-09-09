<?php 
    //importa a sessao
    include_once("../servicos/sessao/inicializador.php");
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="../estilos/interno.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet"/>
        <meta charset="utf-8"/>
        <title>Principal</title>
    </head>
    <body>
        <?php
            //inclui o checador de login para remover dessa página quem não estiver logado
            include_once("../servicos/sessao/checarEstaLogado.php");
        ?>
        <nav>
            <ul>
                <li>
                    CallSYS
                </li>
                <li>
                    <a href="<?php print("http://{$_SERVER['SERVER_NAME']}/estagio/site/interno/principal.php"); ?>">
                        Início
                    </a>
                </li>
                <li>
                    <a href="<?php print("http://{$_SERVER['SERVER_NAME']}/estagio/site/interno/cadastrar_solicitacao.php"); ?>">
                        Solicitação
                    </a>    
                </li>
                <li>
                    Cadastro
                    <ul>
                        <li>
                            <a href="<?php print("http://{$_SERVER['SERVER_NAME']}/estagio/site/interno/cadastrar_funcao.php"); ?>">
                                Função
                            </a>    
                        </li>
                        <li>
                            <a href="<?php print("http://{$_SERVER['SERVER_NAME']}/estagio/site/interno/cadastrar_setor.php"); ?>">
                                Setor
                            </a>    
                        </li>
                        <li>
                            <a href="<?php print("http://{$_SERVER['SERVER_NAME']}/estagio/site/interno/cadastrar_nivel_acesso.php"); ?>">
                                Nível de Acesso
                            </a>    
                        </li>
                        <li>
                            <a href="<?php print("http://{$_SERVER['SERVER_NAME']}/estagio/site/interno/cadastrar_usuario.php"); ?>">
                                Usuário
                            </a>    
                        </li>
                        <li>
                            <a href="<?php print("http://{$_SERVER['SERVER_NAME']}/estagio/site/interno/cadastrar_equipamento.php"); ?>">
                                Equipamento
                            </a>    
                        </li>                        
                    </ul>            
                </li>                
            </ul>
        </nav> 
        <div class="corpo">
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
        </div>
        <footer class="pe">
            <p>Versão do sistema: Demo alpha 0.1</p>
        </footer>
    </body>
</html>