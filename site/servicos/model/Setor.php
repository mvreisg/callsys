<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

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
            $conexao->rollBack();
            var_dump($e);
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
