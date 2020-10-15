function redirecionarParaCadastro(url) {
    location.href = url;
}

function redirecionarParaEstado(url, idSolicitacao) {
    //alert('estado' + idSolicitacao);
    let selectEstado = document.getElementById('estado' + idSolicitacao);
    let optionsEstado = selectEstado.childNodes;
    let optionSelecionada;
    for (let i = 0; i < optionsEstado.length; i++) {
        if (optionsEstado[i].selected) {
            optionSelecionada = optionsEstado[i];
            break;
        }
    }
    url += ("novo_estado=" + optionSelecionada.value + "&");
    //alert(url);
    location.href = url;
}

function pesquisarPorId(url) {
    let inputPesquisa = document.getElementById('input_pesquisa');
    let id = parseInt(inputPesquisa.value);
    url += ("id=" + id + "&");
    //alert(url);
    location.href = url;
}

function redirecionarParaEdicao(url){
    alert(url);
    location.href = url;
}