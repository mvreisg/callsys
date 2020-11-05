<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class Setor
{
    // Atributos
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
        } catch (PDOException $e) {
            // catch dá rollback e retorna o erro
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function alterarPorId()
    {
        // Pega o objeto estático de Conexao
        $conexao = Conexao::get();
        try {
            // Inicia a transação
            $conexao->beginTransaction();

            // Prepara a execução do código SQL pela conexão retornando um PDOStatement
            $declaracao = $conexao->prepare("update setor set nome = :nome, ativo = :ativo where id = :id;");

            // Executa o PDOStatement, retornando um booleano se deu certo ou não
            $deuCerto = $declaracao->execute(
                array(
                    ":id"    => $this->id,
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
        } catch (PDOException $e) {
            // catch dá rollback e retorna o erro
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function alterarAtivo()
    {
        // Checa o valor das variáveis que serão usadas
        if (!isset($this->id)) {
            return array("erro" => "Variável 'ID' não setada");
        }
        if (!isset($this->ativo)) {
            return array("erro" => "Variável 'Ativo' não setada");
        }

        // Pega o objeto de conexao
        $conexao = Conexao::get();
        try {
            // Inicia a transação
            $conexao->beginTransaction();

            // Prepara um update, retornando um PDOStatement
            $declaracao = $conexao->prepare("update setor set ativo = :ativo where id = :id");
            $deuCerto = $declaracao->execute(
                array(
                    ":ativo" => $this->ativo,
                    ":id"    => $this->id
                )
            );
            if ($deuCerto) {
                // Se deu certo, commita e retorna chave de sucesso
                $conexao->commit();
                return array("sucesso" => $declaracao->rowCount());
            } else {
                // Senão, dá rollback e retorna o erro
                $conexao->rollBack();
                return array("erro" => "update de Setor falhou");
            }
        } catch (PDOException $e) {
            // catch retorna erro
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function consultarPorID()
    {
        if (!isset($this->id)) {
            return array("erro" => "id não informado");
        }

        // Pega o objeto estático de Conexao
        $conexao = Conexao::get();
        try {
            $declaracao = $conexao->prepare("select * from setor where id = :id");
            $declaracao->execute(
                array(
                    ":id" => $this->id
                )
            );
            $busca = $declaracao->fetch(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi encontrado nenhum setor com o id {$this->id}");
            } else {                                
                return array(
                    "setor" => new Setor(
                        $busca['id'],
                        $busca['nome'],
                        $busca['ativo']
                    )
                );
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }

    public function consultarPorNome()
    {
        if (!isset($this->nome)) {
            return array("erro" => "nome não informado");
        }

        // Pega o objeto estático de Conexao
        $conexao = Conexao::get();
        try {
            $declaracao = $conexao->prepare("select * from setor where nome like '%{$this->nome}%'");
            $declaracao->execute();
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi encontrado nenhum setor com o nome {$this->nome}");
            } else {
                $setores = array();
                foreach ($busca as $linha) {
                    $setores[] = new Setor(
                        $linha['id'],
                        $linha['nome'],
                        $linha['ativo']
                    );
                }
                return array("setores" => $setores);
            }
        } catch (PDOException $e) {
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

            // Retorna a busca
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);

            // Checa se a busca deu certo
            if (!$busca) {
                // Se não deu certo, retorne o erro
                return array("erro" => "Erro ao buscar todos os Setores");
            } else {
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
            }
        } catch (PDOException $e) {
            // catch retorna erro
            array("erro" => $e);
        }
    }
}
