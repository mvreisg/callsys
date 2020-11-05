<?php
session_start();

// Script PHP que verifica a chave de login da sesão
require_once "../../../servicos/login/verificarLogin.php";

// Importa a classe de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a classe de Setor
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/model/Setor.php";

// URL de redirecionamento para a página de pesquisa
$urlPesquisa = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/setor/pesquisa.php";

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
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/setor/edicao.css" />    
    <script type="application/javascript" src="../../../scripts/interno/setor/edicao.js"></script>
    <meta charset="utf-8" />
    <title>CallSYS - Solicitações</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Editar Setor</h1>     
        <?php if (isset($_GET['alterado'])){ ?>
            <p style="color: green;">Setor alterado com sucesso</p>
        <?php } ?>
        <button onclick="redirecionarParaPesquisa('<?php print $urlPesquisa; ?>');">&#8592; Voltar</button>
        <form name="form_edicao_setor" method="post" action="../../../servicos/operacao/setor/edicao.php">
            <?php 
                $setor = (new Setor($id, null, null))->consultarPorID()['setor'];                                                           
            ?>
            <div>
                <label for="id">ID</label>
                <input id="id" name="id" type="text" readonly value="<?php print $setor->getId(); ?>"/>
            </div>
            <div>
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" value="<?php print $setor->getNome(); ?>"/>
            </div>
            <div>
                <label for="ativo">Ativo</label>
                <input id="ativo" name="ativo" type="checkbox" 
                    <?php 
                        if($setor->getAtivo()){
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