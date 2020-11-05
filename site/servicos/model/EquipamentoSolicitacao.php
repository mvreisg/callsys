<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";
require_once "Equipamento.php";

class EquipamentoSolicitacao
{
    // Atributos
    private $id;
    private $idSolicitacao;
    private $idEquipamento;

    // Construtor
    public function __construct($id, $idSolicitacao, $idEquipamento)
    {
        $this->id = $id;
        $this->idSolicitacao = $idSolicitacao;
        $this->idEquipamento = $idEquipamento;
    }

    // Métodos concretos
    public function inserir()
    {
        // Checagem dos valores
        if (!isset($this->idSolicitacao)) {
            return array("erro" => "idSolicitacao não informado");
        }
        if (!isset($this->idEquipamento)) {
            return array("erro" => "idEquipamento não informado");
        }

        $conexao = Conexao::get();
        try {
            // Não se inicia transaction porque é inserido na transaction da Solicitação                        

            $sql  = "insert into equipamento_solicitacao (id_solicitacao, id_equipamento) ";
            $sql .= "values (:idSolicitacao, :idEquipamento);";
            $declaracao = $conexao->prepare($sql);
            $ok = $declaracao->execute(
                array(
                    ":idSolicitacao" => $this->idSolicitacao,
                    ":idEquipamento" => $this->idEquipamento
                )
            );
            if ($ok) {
                return array("sucesso" => $declaracao->rowCount());
            } else {
                return array("erro" => "EquipamentoSolicitacao não inserido");
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }

    public function alterarEquipamentoPorId()
    {
        // Pega o objeto estático de Conexao
        $conexao = Conexao::get();
        try {
            // Inicia a transação
            $conexao->beginTransaction();

            // Prepara a execução do código SQL pela conexão retornando um PDOStatement
            $prepare = "update equipamento_solicitacao set id_equipamento = :idEquipamento where id = :id;";
            $declaracao = $conexao->prepare($prepare);

            // Executa o PDOStatement, retornando um booleano se deu certo ou não
            $deuCerto = $declaracao->execute(
                array(
                    ":id"            => $this->id,
                    ":idEquipamento" => $this->idEquipamento 
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

    public function consultarIdsPorSolicitacao()
    {
        if (!isset($this->id)) {
            return array("erro" => "id não informado");
        }

        // Pega o objeto estático de Conexao
        $conexao = Conexao::get();
        try {
            $declaracao = $conexao->prepare("select * from equipamento_solicitacao where id_solicitacao = :idSolicitacao");
            $declaracao->execute(
                array(
                    ":idSolicitacao" => $this->idSolicitacao
                )
            );
            $busca = $declaracao->fetch(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi encontrado nenhuma solicitacao com o id {$this->idSolicitacao}");
            } else {                                
                $equipamentoSolicitacoes = array();
                foreach($busca as $linha){
                    $equipamentoSolicitacoes[] = $linha;
                }
                return array(
                    "equipamento_solicitacoes" => $equipamentoSolicitacoes
                );
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }

    public function consultarTodosEquipamentosDaSolicitacao()
    {
        // Checagem das variáveis
        if (!isset($this->idSolicitacao)) {
            return array("erro" => "idSolicitacao nao infromado");
        }

        $conexao = Conexao::get();
        try {
            $declaracao = $conexao->prepare("select * from equipamento_solicitacao where id_solicitacao = :idSolicitacao");
            $declaracao->execute(
                array(
                    ":idSolicitacao" => $this->idSolicitacao
                )
            );
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi encontrado nenhum equipamento vinculado ao id de solcitação {$this->idSolicitacao}");
            } else {
                $equipamentos = array();
                foreach ($busca as $linha) {
                    $resultado = (new Equipamento($linha['id_equipamento'], null, null, null))->consultarPorId();
                    if (isset($resultado['erro'])) {
                        return $resultado;
                    } elseif (isset($resultado['equipamento'])) {
                        $equipamentos[] = $resultado['equipamento'];
                    }
                }
                return array("equipamentos" => $equipamentos);
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }
}
