<?php
session_start();

// Script PHP que verifica a chave de login da sesão
require_once "../../../servicos/login/verificarLogin.php";

// Importa a classe de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a classe de Usuario
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Usuario.php";

// URL de redirecionamento para a página de pesquisa
$urlPesquisa = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/usuario/pesquisa.php";

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
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/usuario/edicao.css" />    
    <script type="application/javascript" src="../../../scripts/interno/usuario/edicao.js"></script>
    <meta charset="utf-8" />
    <title>CallSYS - Solicitações</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Editar Usuário</h1>        
        <?php if (isset($_GET['alterado'])){ ?>
            <p style="color: green;">Usuario alterado com sucesso</p>
        <?php } ?>
        <button onclick="redirecionarParaPesquisa('<?php print $urlPesquisa; ?>');">&#8592; Voltar</button>
        <form name="form_edicao_setor" method="post" action="../../../servicos/operacao/usuario/edicao.php">
            <?php 
                $usuario = (new Usuario($id, null, null, null, null, null, null, null))->consultarPorID()['usuario'];                                                           
            ?>
            <div>
                <label for="id">ID</label>
                <input id="id" name="id" type="text" readonly value="<?php print $usuario->getId(); ?>"/>
            </div>
            <div>
                <label for="id_setor">ID Setor</label>
                <input id="id_setor" name="id_setor" type="text" readonly value="<?php print $usuario->getIdSetor(); ?>"/>
            </div>
            <div>
                <label for="id_funcao">ID Função</label>
                <input id="id_funcao" name="id_funcao" type="text" readonly value="<?php print $usuario->getIdFuncao(); ?>"/>
            </div>
            <div>
                <label for="id_nivel_acesso">ID Nível de Acesso</label>
                <input id="id_nivel_acesso" name="id_nivel_acesso" type="text" readonly value="<?php print $usuario->getIdNivelAcesso(); ?>"/>
            </div>
            <div>
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" value="<?php print $usuario->getNome(); ?>"/>
            </div>
            <div>
                <label for="usuario">Usuario</label>
                <input id="usuario" name="usuario" type="text" value="<?php print $usuario->getUsuario(); ?>"/>
            </div>
            <div>
                <label for="senha">Senha</label>
                <input id="senha" name="senha" type="text" value="<?php print $usuario->getSenha(); ?>"/>
            </div>
            <div>
                <label for="ativo">Ativo</label>
                <input id="ativo" name="ativo" type="checkbox" 
                    <?php 
                        if($usuario->getAtivo()){
                            print 'checked';
                        } 
                    ?>
                "/>
            </div>
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