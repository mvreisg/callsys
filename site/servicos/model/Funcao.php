<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class Funcao
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
        // Pega o objeto de conexão com o banco
        $conexao = Conexao::get();
        try {
            // Inicia a transação
            $conexao->beginTransaction();

            // Prepara o comando SQL para execução, gerando uma declaração
            $declaracao = $conexao->prepare("insert into funcao (nome, ativo) values (:nome, :ativo);");

            // Executa a declaração, retornando se deu certo ou não
            $deuCerto = $declaracao->execute(
                array(
                    ":nome"  => $this->nome,
                    ":ativo" => $this->ativo
                )
            );
            if ($deuCerto) {
                // Se deu certo, commite e retorne chave de sucesso
                $conexao->commit();
                return array("sucesso" => $declaracao->rowCount());
            } else {
                // Senão, dê rollback e retorne erro
                $conexao->rollBack();
                return array("erro" => "Função não foi inserida");
            }
        } catch (PDOEXception $e) {
            // catch dá rollback e retorna exception
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
            $declaracao = $conexao->prepare("update funcao set nome = :nome, ativo = :ativo where id = :id;");

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
                return array("erro" => "Edição mal-sucedida");
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
            $declaracao = $conexao->prepare("update funcao set ativo = :ativo where id = :id");
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
                return array("erro" => "Não foi possível alterar a Função");
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
            $declaracao = $conexao->prepare("select * from funcao where id = :id");
            $declaracao->execute(
                array(
                    ":id" => $this->id
                )
            );
            $busca = $declaracao->fetch(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi encontrado nenhuma função com o id {$this->id}");
            } else {                                
                return array(
                    "funcao" => new Funcao(
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
            $declaracao = $conexao->prepare("select * from funcao where nome like '%{$this->nome}%'");
            $declaracao->execute();
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi encontrada nenhuma função com o nome {$this->nome}");
            } else {
                $funcoes = array();
                foreach ($busca as $linha) {
                    $funcoes[] = new Funcao(
                        $linha['id'],
                        $linha['nome'],
                        $linha['ativo']
                    );
                }
                return array("funcoes" => $funcoes);
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }

    public function consultarTodos()
    {
        // Pega o objeto de conexão com o banco
        $conexao = Conexao::get();
        try {
            // Prepara a execução SQL, retornando uma declaração
            $declaracao = $conexao->prepare("select * from funcao");

            // Executa a declaração, retornando se deu certo
            $deuCerto = $declaracao->execute();

            if ($deuCerto) {
                // Se deu certo, retorne os objetos Funcao
                $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);
                $funcoes = array();
                foreach ($busca as $linha) {
                    $funcoes[] = new Funcao(
                        $linha['id'],
                        $linha['nome'],
                        $linha['ativo']
                    );
                }
                return array("funcoes" => $funcoes);
            } else {
                // Senão, retorne o erro                
                return array("erro" => "Função não pôde ser consultada");
            }
        } catch (PDOException $e) {
            // catch retorna exception
            return array("erro" => $e);
        }
    }
}
