<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class Setor
{
    private $id;
    private $nome;
    private $ativo;

    // Construtor
    public function __construct($id, $nome, $ativo)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    // Métodos concretos
    public function inserir()
    {
        // Pega o objeto estático de Conexao
        $conexao = Conexao::get();
        try {
            // TODO: Checar se setor já existe

            // Inicia a transação
            $conexao->beginTransaction();

            // Prepara a execução do código SQL pela conexão retornando um PDOStatement
            $declaracao = $conexao->prepare("insert into setor (nome, ativo) values (:nome, :ativo);");

            // Executa o PDOStatement, retornando um booleano se deu certo ou não
            $deuCerto = $declaracao->execute(
                array(
                    ":nome"  => $this->nome,
                    ":ativo" => $this->ativo
                )
            );

            // Checa se deu certo
            if ($deuCerto) {
                // Se deu certo, commita a transação e retorna uma chave de sucesso com a quantidade de linhas afetadas
                $conexao->commit();
                return array("sucesso" => $declaracao->rowCount());
            } else {
                // Senão, da rollback e retorna o erro
                $conexao->rollBack();
                return array("erro" => "Inserção de Setor mal-sucedida");
            }
        } catch (PDOEXception $e) {
            // catch dá rollback e retorna o erro
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function alterarAtivo()
    {
        $conexao = Conexao::get();
        try {
            $conexao->beginTransaction();
            $declaracao = $conexao->prepare("update setor set ativo = :ativo where id = :id");
            $deuCerto = $declaracao->execute();
            if ($deuCerto) {
                $conexao->commit();
                return array("sucesso" => $declaracao->rowCount());
            } else {
                $conexao->rollBack();
                return array("erro" => "update de Setor falhou");
            }
        } catch (PDOException $e) {
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function consultarTodos()
    {
        // Pega o objeto estático de Conexao
        $conexao = Conexao::get();
        try {
            // Prepara uma declaração de consulta no banco
            $declaracao = $conexao->prepare("select * from setor");

            // Executa a declaração
            $declaracao->execute();
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);

            // Checa se a busca deu certo
            if (!$busca) {
                // Se não deu certo, retorne o erro
                return array("erro" => "Erro ao buscar todos os Setores");
            }
            // Se deu certo, 

            // Preencha o array de objetos Setor
            $setores = array();
            foreach ($busca as $setor) {
                $setores[] = new Setor(
                    $setor['id'],
                    $setor['nome'],
                    $setor['ativo']
                );
            }
            // Retorna um array com os objetos Setor associados a uma chave 'setores'
            return array("setores" => $setores);
        } catch (PDOException $e) {
            // catch retorna erro
            array("erro" => $e);
        }
    }
}
