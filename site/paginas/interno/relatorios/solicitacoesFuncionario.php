<?php
session_start();

// Script PHP que verifica a chave de login da sesão
require_once "../../../servicos/login/verificarLogin.php";

if (isset($_POST['submit']) && isset($_POST['inicio']) && isset($_POST['ate'])){
    $inicio = $_POST['inicio'];
    $ate = $_POST['ate'];
    require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

    $conexao = Conexao::get();

    $sql = "select * from solicitacao s inner join usuario u on s.id_usuario = u.id where data_hora_solicitacao between '" . $inicio . "' and '" . $ate . "';";
    $declaracao = $conexao->prepare($sql);
    $declaracao->execute();
    $resultado = $declaracao->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <link rel="stylesheet" type="text/css" href="../../../estilos/reset.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/fontes/fontes.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/interno.css" />
    <link rel="stylesheet" type="text/css" href="../../../estilos/interno/relatorios/relatorio.css" />    
    <meta charset="utf-8" />
    <title>CallSYS - Relatórios</title>
</head>

<body>
    <nav>
        <?php require_once "../nav.php"; ?>
    </nav>
    <section>
        <h1>Relatório de Solicitações por Funcionário</h1>    
        <div>
            <form action=" <?php echo $_SERVER['PHP_SELF']; ?> " method="POST">
                <label for="inicio">Inicio</label>
                <input type="date" name="inicio"/>
                <label for="ate">Até</label>
                <input type="date" name="ate"/>
                <input type="submit" name="submit" value="Gerar"/>
            </form>            
        </div>
        <table>
            <tr>
                <th>ID da Solicitação</th>
                <th>ID do Usuário</th>
                <th>Data e Hora da Solicitação</th>
            </tr>
            <?php 
            foreach($resultado as $tupla){
                print "<tr>";                
                print "<td>" . $tupla['id'] . "</td>";
                print "<td>" . $tupla['id_usuario'] . "</td>";
                print "<td>" . $tupla['data_hora_solicitacao'] . "</td>";
                print "</tr>";
            }
            ?>
        </table>
    </section>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
</body>

</html>