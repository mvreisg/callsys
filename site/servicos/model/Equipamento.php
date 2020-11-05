<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class Equipamento
{
    // Atributos
    private $id;
    private $nome;
    private $ativo;
    private $dataHoraCadastro;

    // Construtor
    public function __construct($id, $nome, $ativo, $dataHoraCadastro)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->ativo = $ativo;
        $this->dataHoraCadastro = $dataHoraCadastro;
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

    public function getDataHoraCadastro()
    {
        return $this->dataHoraCadastro;
    }

    // Métodos concretos
    public function inserir()
    {
        // Pega o objeto de conexão com o banco
        $conexao = Conexao::get();
        try {
            // Inicia a transação
            $conexao->beginTransaction();

            // Prepara uma inserção no banco, retornando uma delaração
            $declaracao = $conexao->prepare(
                "insert into equipamento (nome, ativo, data_hora_cadastro) values (:nome, :ativo, now());"
            );

            // Executa e retorna uma flag de sucesso
            $sucesso = $declaracao->execute(
                array(
                    ":nome"  => $this->nome,
                    ":ativo" => $this->ativo,
                )
            );
            if ($sucesso) {
                // Se sucedeu, commita e retorna 'sucesso'
                $conexao->commit();
                return array("sucesso" => $declaracao->rowCount());
            } else {
                // Senão, dá rollback e retorna erro
                $conexao->rollBack();
                return array("erro" => "Não foi possível inserir o Equipamento");
            }
        } catch (PDOException $e) {
            // catch dá rollback e retorna erro
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
            $declaracao = $conexao->prepare("update equipamento set nome = :nome, ativo = :ativo where id = :id;");

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
            $declaracao = $conexao->prepare("update equipamento set ativo = :ativo where id = :id");
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
                return array("erro" => "update de Equipamento falhou");
            }
        } catch (PDOException $e) {
            // catch retorna erro
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function consultarPorId()
    {
        // Checa consistencia dos dados
        if (!isset($this->id)) {
            return array("erro" => "id não informado");
        }

        // Pega o objeto de conexão com o banco
        $conexao = Conexao::get();
        try {
            // Prepara uma consulta no banco, retornando uma delaração
            $declaracao = $conexao->prepare("select * from equipamento where id = :id");

            // Executa a daclaração
            $declaracao->execute(
                array(
                    ":id" => $this->id
                )
            );

            // Busca o resultado
            $busca = $declaracao->fetch(PDO::FETCH_ASSOC);

            if (!$busca) {
                // Se deu falso, retorna erro
                return array("erro" => "Não foi encontrado Equipamento com o ID {$this->id}");
            } else {
                // Senão, retornar Equipamento
                $equipamento = new Equipamento(
                    $this->id,
                    $busca['nome'],
                    $busca['ativo'],
                    $busca['data_hora_cadastro']
                );
                return array("equipamento" => $equipamento);
            }
        } catch (PDOException $e) {
            // catch retorna erro            
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
            $declaracao = $conexao->prepare("select * from equipamento where nome like '%{$this->nome}%'");
            $declaracao->execute();
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi encontrado nenhum equipamento com o nome {$this->nome}");
            } else {
                $equipamentos = array();
                foreach ($busca as $linha) {
                    $equipamentos[] = new Equipamento(
                        $linha['id'],
                        $linha['nome'],
                        $linha['ativo'],
                        $linha['data_hora_cadastro']
                    );
                }
                return array("equipamentos" => $equipamentos);
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
            // Prepara uma consulta no banco, retornando uma delaração
            $declaracao = $conexao->prepare("select * from equipamento");

            // Executa a declaração
            $declaracao->execute();

            // Retorna a busca
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);

            if (!$busca) {
                // Se deu errado, retorna erro
                return array("erro" => "Não foi possível buscar os Equipamentos");
            } else {
                // Senão, retorne os equipamentos
                $equipamentos = array();
                foreach ($busca as $linha) {
                    $equipamentos[] = new Equipamento(
                        $linha['id'],
                        $linha['nome'],
                        $linha['ativo'],
                        $linha['data_hora_cadastro']
                    );
                }
                return array("equipamentos" => $equipamentos);
            }
        } catch (PDOException $e) {
            // catch retorna erro            
            return array("erro" => $e);
        }
    }
}
