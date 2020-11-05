<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";
require_once "Usuario.php";
require_once "Equipamento.php";
require_once "EquipamentoSolicitacao.php";

class Solicitacao
{
    // Atributos
    private $id;
    private $idUsuario;
    private $estado;
    private $descricaoProblema;
    private $dataHoraSolicitacao;

    // Construtor
    public function __construct($id, $idUsuario, $estado, $descricaoProblema, $dataHoraSolicitacao)
    {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->estado = $estado;
        $this->descricaoProblema = $descricaoProblema;
        $this->dataHoraSolicitacao = $dataHoraSolicitacao;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getDescricaoProblema()
    {
        return $this->descricaoProblema;
    }

    public function getDataHoraSolicitacao()
    {
        return $this->dataHoraSolicitacao;
    }

    // Métodos concretos
    public function inserir($idsEquipamentos)
    {
        $conexao = Conexao::get();
        try {
            // Verificando consistência dos dados
            if (!isset($this->idUsuario)) {
                return array("erro" => "idUsuario não informado");
            }
            if (!isset($this->estado)) {
                return array("erro" => "estado não informado");
            }
            if (!isset($this->descricaoProblema)) {
                return array("erro" => "descricaoProblema não informado");
            }

            // Verifica se o usuário existe            
            $resultadoUsuarioExiste = (new Usuario($this->idUsuario, null, null, null, null, null, null, null))->consultarPorId();
            if (!isset($resultadoUsuarioExiste['usuario'])) {
                return array("erro" => "Usuário não existe");
            }

            // \/ \/ \/ Verifica se os equipamentos existem \/ \/ \/

            // Criação do array de objetos Equipamento associados a Solicitacao
            $equipamentos = array();

            // Percorre o array de IDs de Equipamentos expondo cada ID
            foreach ($idsEquipamentos as $idEquipamento) {
                // Gera o objeto Equipamento com base no ID
                $equipamentoBase = new Equipamento($idEquipamento, null, null, null);
                $resultadoEquipamento = $equipamentoBase->consultarPorId();

                // Verifica se o equipamento não existe
                if (!isset($resultadoEquipamento['equipamento'])) {
                    // Se não existe, cancelar e retornar erro
                    return array("erro" => "Não existe Equipamento com o ID $idEquipamento");
                }
                // Senão, popula o array de equipamentos
                $equipamentos[] = $resultadoEquipamento['equipamento'];
            }

            // /\ /\ /\ Verifica se os equipamentos existem /\ /\ /\

            // \/ \/ \/ Transação: Inserção Solicitacao e os EquipamentoSolicitacao associados \/ \/ \/

            // Inicia a transação que só irá terminar com a inserção de todos os objetos EquipamentoSolicitacao
            $conexao->beginTransaction();

            // SQL de inserção na tabela Solicitacao
            $sqlSolicitacao  = "insert into solicitacao (id_usuario, estado, descricao_problema, data_hora_solicitacao) ";
            $sqlSolicitacao .= "values (:idUsuario, :estado, :descricaoProblema, now());";

            // Inserção na tabela Solicitação
            $declaracaoSolicitacao = $conexao->prepare($sqlSolicitacao);
            // Insere a Solicitacao no banco
            $solicitacaoOK = $declaracaoSolicitacao->execute(
                array(
                    ":idUsuario"           => $this->idUsuario,
                    ":estado"              => $this->estado,
                    ":descricaoProblema"   => $this->descricaoProblema,
                )
            );

            // Checa se a solicitação não foi incluida com sucesso            
            if (!$solicitacaoOK) {
                // Se não foi incluída com sucesso, dar rollback e retornar o erro
                $conexao->rollBack();
                return array("erro" => "Erro ao inserir a solicitação");
            }

            // Pega o ultimo ID inserido (ID da Solicitacao)                        
            $idSolicitacao = -1;
            $declaracaoUltimoID = $conexao->prepare("select LAST_INSERT_ID();");
            if (!$declaracaoUltimoID->execute()) {
                $conexao->rollBack();
                return array("erro" => "Erro ao consultar o último ID inserido na tabela Solicitação");
            }
            $idSolicitacao = $declaracaoUltimoID->fetch(PDO::FETCH_ASSOC)['LAST_INSERT_ID()'];

            // Inserção dos objetos EquipamentoSolicitacao                        
            foreach ($idsEquipamentos as $idEquipamento) {
                $equipamentoSolicitacao = new EquipamentoSolicitacao(null, $idSolicitacao, $idEquipamento);

                // Insere o objeto EquipamentoSolicitacao na tabela correspondente
                $resultado = $equipamentoSolicitacao->inserir();

                // Verifica se o resultado retornou um array com a chave 'erro'
                if (isset($resultado['erro'])) {
                    // Se sim, rollback e retorna a mensagem de erro
                    $conexao->rollBack();
                    return $resultado;
                }
            }

            // Commita a transação
            $conexao->commit();

            // /\ /\ /\ Transação: Inserção Solicitacao e os EquipamentoSolicitacao associados /\ /\ /\

            // Retorna a mensagem de sucesso
            return array("sucesso" => "Solicitação inserida com sucesso");
        } catch (PDOException $e) {
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function alterarPorId()
    {
        $conexao = Conexao::get();
        try {
            // Verificando consistência dos dados
            if (!isset($this->id)){
                return array("erro" => "id não informado");
            }
            if (!isset($this->idUsuario)) {
                return array("erro" => "idUsuario não informado");
            }
            if (!isset($this->descricaoProblema)) {
                return array("erro" => "descricaoProblema não informado");
            }

            // Inicia a transação que só irá terminar com a edição de todos os objetos EquipamentoSolicitacao
            $conexao->beginTransaction();

            // SQL de edição na tabela Solicitacao
            $sqlSolicitacao  = "update solicitacao set id_usuario = :idUsuario, descricao_problema = :descricaoProblema ";
            $sqlSolicitacao .= "where id = :id;";

            // Inserção na tabela Solicitação
            $declaracaoSolicitacao = $conexao->prepare($sqlSolicitacao);
            // Insere a Solicitacao no banco
            $solicitacaoOK = $declaracaoSolicitacao->execute(
                array(
                    ":id"                  => $this->id,
                    ":idUsuario"           => $this->idUsuario,                    
                    ":descricaoProblema"   => $this->descricaoProblema
                )
            );

            // Checa se a solicitação não foi editada com sucesso            
            if (!$solicitacaoOK) {
                // Se não foi editada com sucesso, dar rollback e retornar o erro
                $conexao->rollBack();
                return array("erro" => "Erro ao editar a solicitação");
            }

            // Commita a transação
            $conexao->commit();

            // Retorna a mensagem de sucesso
            return array("sucesso" => "Solicitação editada com sucesso");
        } catch (PDOException $e) {
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function alterarEstado()
    {
        // Checa o valor das variáveis que serão usadas
        if (!isset($this->id)) {
            return array("erro" => "Variável 'ID' não setada");
        }
        if (!isset($this->estado)) {
            return array("erro" => "Variável 'Estado' não setada");
        }

        // Pega o objeto de conexao
        $conexao = Conexao::get();
        try {
            // Inicia a transação
            $conexao->beginTransaction();

            // Prepara um update, retornando um PDOStatement
            $declaracao = $conexao->prepare("update solicitacao set estado = :estado where id = :id");
            $deuCerto = $declaracao->execute(
                array(
                    ":estado" => $this->estado,
                    ":id"     => $this->id
                )
            );
            if ($deuCerto) {
                // Se deu certo, commita e retorna chave de sucesso
                $conexao->commit();
                return array("sucesso" => $declaracao->rowCount());
            } else {
                // Senão, dá rollback e retorna o erro
                $conexao->rollBack();
                return array("erro" => "alteração de estado da solicitacão {$this->id} falhou");
            }
        } catch (PDOException $e) {
            // catch retorna erro
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function consultarPorId()
    {
        if (!isset($this->id)) {
            return array("erro" => "id não informado");
        }

        $conexao = Conexao::get();
        try {
            $declaracao = $conexao->prepare("select * from solicitacao where id = :id");
            $declaracao->execute(
                array(
                    ":id" => $this->id
                )
            );
            $busca = $declaracao->fetch(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi possível encontrar a solicitação com o ID {$this->id}");
            } else {
                $solicitacao = new Solicitacao(
                    $busca['id'],
                    $busca['id_usuario'],
                    $busca['estado'],
                    $busca['descricao_problema'],
                    $busca['data_hora_solicitacao']
                );
                return array("solicitacao" => $solicitacao);
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }

    public function consultarTodos()
    {
        $conexao = Conexao::get();
        try {
            $declaracao = $conexao->prepare("select * from solicitacao");
            $declaracao->execute();
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi possível consultar todas as solicitações");
            } else {
                $solicitacoes = array();
                foreach ($busca as $linha) {
                    $solicitacoes[] = new Solicitacao(
                        $linha['id'],
                        $linha['id_usuario'],
                        $linha['estado'],
                        $linha['descricao_problema'],
                        $linha['data_hora_solicitacao']
                    );
                }
                return array("solicitacoes" => $solicitacoes);
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }

    public function consultarEquipamentosAssociados()
    {
        if (!isset($this->id)) {
            return array("erro" => "id não informado");
        }
        return (new EquipamentoSolicitacao(null, $this->id, null))->consultarTodosEquipamentosDaSolicitacao();
    }
}
