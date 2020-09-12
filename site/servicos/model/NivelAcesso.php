<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class NivelAcesso
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
            // TODO: Checar se nível de acesso já existe
            $conexao->beginTransaction();
            $sqlInsercao = "insert into nivel_acesso (nome, ativo) values (:nome, :ativo);";
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
            $conexao->rollBack();
            var_dump($e);
        }
    }

    public function consultarTodos()
    {
        $conexao = Conexao::get();
        try {
            $sqlSelectTodos = "select * from nivel_acesso";
            $declaracao = $conexao->prepare($sqlSelectTodos);
            $declaracao->execute();
            return $declaracao->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
