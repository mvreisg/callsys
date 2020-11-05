<?php
session_start();

// Script PHP que verifica a chave de login da sesão
require_once "../../../servicos/login/verificarLogin.php";

// Importa a classe de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a classe de Solicitação
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Solicitacao.php";

// URL de redirecionamento para a página de pesquisa
$urlPesquisa = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/solicitacao/pesquisa.php";

if (isset($_GET['id'])){
    $id = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/interno.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/solicitacao/edicao.css" />    
    <script type="application/javascript" src="../../../scripts/interno/solicitacao/edicao.js"></script>
    <meta charset="utf-8" />
    <title>CallSYS - Solicitações</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Editar Solicitação</h1>        
        <button onclick="redirecionarParaPesquisa('<?php print $urlPesquisa; ?>');">&#8592; Voltar</button>
        <?php if (isset($_GET['alterado'])){ ?>
            <p style="color: green;">Solicitação alterada com sucesso</p>
        <?php } ?>
        <form name="form_cadastro_solicitacao" action="../../../servicos/operacao/solicitacao/edicao.php" method="post">
            <?php 
                $solicitacao = (new Solicitacao($id, null, null, null, null))->consultarPorID()['solicitacao'];                                                           
            ?>
            <div>
                <label for="id">ID</label>
                <input id="id" name="id" type="text" readonly value="<?php print $solicitacao->getId(); ?>"/>
            </div>

            <!-- Usuario -->
            <div>
                <label class="block" for="id_usuario">Usuário</label>
                <select class="block" name="id_usuario">
                <?php
                    require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Usuario.php";

                    $resultado = (new Usuario(null, null, null, null, null, null, null, null))->consultarTodos();
                    $usuarioSelect = (new Usuario($solicitacao->getIdUsuario(), null, null, null, null, null, null, null))->consultarPorId()['usuario'];
                    $usuarios = $resultado['usuarios'];

                    foreach ($usuarios as $usuario) { ?>
                        <option 
                        <?php if ($usuario->getId() === $usuarioSelect->getId()) {?>
                            selected
                        <?php } ?>
                        value="<?php print $usuario->getID(); ?>"><?php print $usuario->getNome(); ?></option>;
                    <?php } 
                ?>                
                </select>
            </div>

            <!-- Equipamento 
            
            <div>
                <span class="block">Selecionar Equipamento</span>
                <?php
                    //require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Equipamento.php";

                    //$resultado = (new Equipamento(null, null, null, null))->consultarTodos();                
                    //$equipamentos = $resultado['equipamentos'];
                    //$equipamentosAssociados = $solicitacao->consultarEquipamentosAssociados()['equipamentos'];

                    //foreach ($equipamentos as $equipamento) { ?>
                        <div class="block">
                            <input 
                            <?php //foreach($equipamentosAssociados as $equipamentoAssociado) {
                                //if ($equipamento->getId() === $equipamentoAssociado->getId()){ ?>
                            checked 
                            <?php //} 
                            //}
                            ?>
                            class="inline-block" type="checkbox" name="equipamento<?php //print $equipamento->getId();?>" value="<?php //print $equipamento->getId();?>"/>
                            <label class="inline-block" for="<?php //print $equipamento->getId();?>"/><?php //print $equipamento->getNome();?></label>
                        </div>
                    <?php //} 
                ?>
            </div>
            -->

            <!-- Descrição do Problema -->
            <div>
                <label class="block" for="descricao_problema">Descrição do problema</label>
                <textarea name="descricao_problema" rows="20" cols="50"><?php print $solicitacao->getDescricaoProblema(); ?></textarea>
            </div>

            <!-- Ações -->
            <div>
                <input type="submit" name="submit" value="Editar"/>
            </div>
        </form>
    </section>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
</body>

</html>