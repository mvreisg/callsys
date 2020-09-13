<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

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

    public function getId()
    {
        return $this->id;
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

    public function existe()
    {
        $conexao = Conexao::get();
        try {
            $sqlSelect = "select * from equipamento where id = :id";
            $declaracao = $conexao->prepare($sqlSelect);
            $declaracao->execute(
                array(
                    ":id" => $this->id
                )
            );
            return $declaracao->rowCount() > 0;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function consultar()
    {
        $conexao = Conexao::get();
        try {
            $sqlSelect = "select * from equipamento where id = :id";
            $declaracao = $conexao->prepare($sqlSelect);
            $declaracao->execute(
                array(
                    ":id" => $this->id
                )
            );
            return $declaracao->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function consultarTodos()
    {
        $conexao = Conexao::get();
        try {
            $sqlSelectTodos = "select * from equipamento";
            $declaracao = $conexao->prepare($sqlSelectTodos);
            $declaracao->execute();
            return $declaracao->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
