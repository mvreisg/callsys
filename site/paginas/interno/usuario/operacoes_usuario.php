<?php 
    session_start();        
    
    // Importa o arquivo que checa se há login
    require_once "../../login/temLogin.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="../../../estilos/fontes.css"/>
        <link rel="stylesheet" type="text/css" href="../../../estilos/geral.css"/>        
        <link rel="stylesheet" type="text/css" href="../../../estilos/interno.css"/>        
        <link rel="stylesheet" type="text/css" href="../../../estilos/cadastro.css"/>        
        <meta charset="utf-8"/>
        <title>CallSYS - Operações - Usuário</title>        
    </head>
    <body>              
        <nav>
            <?php require_once "../nav.php"; ?>
        </nav> 
        <section>
            <h1>Cadastrar Usuário</h1>
            <form name="form_cadastro_usuario" action="" method="post">                                
                <!-- NOME -->
                <div>
                    <label class="block" for="usuario">Nome</label>
                    <input class="block" type="text" name="nome" placeholder="" required />
                </div>
                
                <!-- USUARIO -->
                <div>
                    <label class="block" for="usuario">Usuário</label>
                    <input class="block" type="text" name="usuario" placeholder="" required>
                </div>
                
                <!-- SENHA -->
                <div>
                    <label class="block" for="senha">Senha</label>
                    <input class="block" type="password" name="senha" placeholder="" required>
                </div>

                <!-- TODO: Gerar via PHP -->
                <!-- FUNÇÃO -->
                <div>
                    <label class="block" for="funcao">Função</label>
                    <select class="block" name="funcao">
                    <option value="">Enfermeiro</option>
                    <option value="">Administrativo</option>
                    <option value="">Médico</option>
                    </select>
                </div>

                <!-- TODO: Gerar via PHP -->
                <!-- SETOR -->
                <div>
                    <label class="block" for="setor">Setor</label>
                    <select class="block" name="setor">
                    <option value="">Ambulatório</option>
                    <option value="">Administrativo</option>
                    <option value="">Tecnologia da Informação</option>
                    </select>
                </div>

                <!-- TODO: Gerar via PHP -->
                <!-- NIVEL ACESSO -->
                <div>
                    <label class="block" for="nivel_acesso">Nível de Acesso</label>
                    <select class="block" name="nivel_acesso">
                    <option value="">Usuário</option>
                    <option value="">Supervisor</option>
                    <option value="">TI</option>
                    </select>
                </div>
                                               
                <!-- ATIVO -->
                <div>
                    <label class="inline-block" for="ativo">Ativo</label>
                    <input class="inline-block" type="checkbox" name="ativo">
                </div>

                <div>
                    <!-- CONFIRMAR -->                
                    <input class="inline-block" type="submit" name="" value="Confirmar">                

                    <!-- CANCELAR -->
                    <input class="inline-block" type="button" name="" value="Cancelar">

                    <!-- LIMPAR -->
                    <input class="inline-block" type="button" name="" value="Limpar">
                </div>
            </form>
        </section>
        <footer>
            <?php require_once "../footer.php"; ?>
        </footer>
    </body>
</html>