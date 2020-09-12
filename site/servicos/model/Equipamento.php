<?php
require_once "../../../servicos/conexao/Conexao.php";

class Equipamento
{
    private $id;
    private $nome;
    private $ativo;
    private $dataHoraCadastro;

    public function __construct($id, $nome, $ativo, $dataHoraCadastro)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->ativo = $ativo;
        $this->dataHoraCadastro = $dataHoraCadastro;
    }

    public function inserir()
    {
        // TODO: Checar se equipamento já existe
        $conexao = Conexao::get();
        try {
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
