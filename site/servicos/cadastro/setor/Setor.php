<?php
require_once "../../conexao/Conexao.php";

class Setor
{
    private $id;
    private $nome;
    private $ativo;

    public function __construct($id, $nome, $ativo)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function inserir()
    {
        $conexao = Conexao::get();
        try {
            // TODO: Checar se setor já existe
            $conexao->beginTransaction();
            $sqlInsercao = "insert into setor (nome, ativo) values (:nome, :ativo);";
            $declaracao = $conexao->prepare($sqlInsercao);
            $deuCerto = $declaracao->execute(
                array(
                    ":nome"  => $this->nome,
                    ":ativo" => $this->ativo
                )
            );
            if ($deuCerto) {
                $conexao->commit();
            } else {
                $conexao->rollBack();
            }
            return $declaracao->rowCount();
        } catch (PDOEXception $e) {
            var_dump($e);
        }
    }
}
