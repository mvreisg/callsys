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
            <h1 style=" color: black">Solicitações</h1>
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
        </div>
        <footer class="pe">
            <p>Versão do sistema: Demo alpha 0.1</p>
        </footer>
    </body>
</html>