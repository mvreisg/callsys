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
            $conexao->beginTransaction();
            $sqlInsercao = "insert into equipamento (nome, ativo, data_hora_cadastro) values (:nome, :ativo, now());";
            $declaracao = $conexao->prepare($sqlInsercao);
            $deuCerto = $declaracao->execute(
                array(
                    ":nome"  => $this->nome,
                    ":ativo" => $this->ativo,
                )
            );
            if ($deuCerto) {
                $conexao->commit();
            } else {
                $conexao->rollBack();
            }
            return $declaracao->rowCount();
        } catch (PDOException $e) {
            $conexao->rollBack();
            var_dump($e);
        }
    }
}
