<?php
session_start();

// Importa o arquivo de Request
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/request/Request.php";

// Importa a model de Usuario
require_once "../model/Usuario.php";

// URL para retornar a página de login
$urlIndex = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/index.php?";

// URL para ir para a página inicial do sistema
$urlInicio = Request::PREFIXO_URL . "{$_SERVER['SERVER_NAME']}/estagio/site/paginas/interno/inicio.php";

// URL para redirecionamento
$urlRedirecionamento = $urlIndex;

// Checa se o formulário foi submitado
if (isset($_POST['submitLogin'])) {
    // Se o formulário foi submitado, 

    // Checa se o usuario e a senha foram passados
    $dadosPassados = true;
    if (!isset($_POST['usuario'])) {
        // Se o usuário não foi passada, retornar a página de login e informar ao usuário
        $urlRedirecionamento .= "usuario=vazio&";
        $dadosPassados = false;
    }

    if (!isset($_POST['senha'])) {
        // Se a senha não foi passada, retornar a página de login e informar ao usuário
        $urlRedirecionamento .= "senha=vazio&";
        $dadosPassados = false;
    }

    if ($dadosPassados) {
        // Se os dados foram passados corretamente
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // Verifica se tem permissão para logar, capturando o resultado
        // (se usuario existe e se está ativo)
        $resultado = (new Usuario(null, null, null, null, null, $usuario, $senha, null))->verificarPermissaoParaLogar();

        // Filtrando dados do resultado
        $existe = $resultado['existe'];
        $ativo = $resultado['ativo'];

        // Checa se o usuário existe
        if ($existe) {
            // Se o usuário existe
            if ($ativo) {
                // Se o usuário está ativo
                $_SESSION['login'] = true;
                // Seta a URL de redirecionamento para a página de início
                $urlRedirecionamento = $urlInicio;
            } else {
                // Se o usuário não está ativo, retorna que existe mas não está ativo
                $urlRedirecionamento .= "existe=$existe&ativo=$ativo";
            }
        } else {
            // Se o usuário não existe, retorna que ele não existe
            $urlRedirecionamento .= "existe=$existe&";
        }
    }
}
?>

<!-- JavaScript -->
<script type="text/javascript">
    // Redireciona via JavaScript para a URL que está guardada na variável PHP de URL de redirecionamento
    location.href = '<?php print $urlRedirecionamento; ?>';
</script>