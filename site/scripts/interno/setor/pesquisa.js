function redirecionarParaCadastro(url) {
    location.href = url;
}

function redirecionarParaAtivo(url) {
    location.href = url;
}

function pesquisarPorNome(url) {
    let inputPesquisa = document.getElementById('input_pesquisa');
    let nome = inputPesquisa.value;
    url += ("nome=" + nome + "&");
    location.href = url;
}

function redirecionarParaEdicao(url){
    location.href = url;
}