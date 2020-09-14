<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";
require_once "Usuario.php";
require_once "Equipamento.php";
require_once "EquipamentoSolicitacao.php";

class Solicitacao
{
    // Dados do objeto Solicitação
    private $id;
    private $idUsuario;
    private $estado;
    private $descricaoProblema;
    private $dataHoraSolicitacao;

    public function __construct($id, $idUsuario, $estado, $descricaoProblema, $dataHoraSolicitacao)
    {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->estado = $estado;
        $this->descricaoProblema = $descricaoProblema;
        $this->dataHoraSolicitacao = $dataHoraSolicitacao;
    }

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
            if (!(new Usuario($this->idUsuario, null, null, null, null, null, null, null))->existe()) {
                return array("erro" => "Usuário não existe");
            }

            // \/ \/ \/ Verifica se os equipamentos existem \/ \/ \/

            // Criação do array de objetos Equipamento associados a Solicitacao
            $equipamentos = array();

            // Percorre o array de IDs de Equipamentos expondo cada ID
            foreach ($idsEquipamentos as $idEquipamento) {
                // Gera o objeto Equipamento com base no ID
                $equipamentoBase = new Equipamento($idEquipamento, null, null, null);
                $equipamentoCompleto = $equipamentoBase->consultarPorId();

                // Verifica se o equipamento não existe
                if (!isset($equipamentoCompleto)) {
                    // Se não existe, cancelar e retornar erro
                    return array("erro" => "Não existe Equipamento com o ID $idEquipamento");
                }
                // Senão, popula o array de equipamentos
                $equipamentos[] = $equipamentoCompleto;
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
}
