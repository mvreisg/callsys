<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";
require_once "Usuario.php";
require_once "Equipamento.php";

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
        $this->equipamentos = array();
    }

    public function inserir($idsEquipamentos)
    {
        $conexao = Conexao::get();
        try {
            // Verificando consistência dos dados
            if (!isset($this->idUsuario)) {
                return 0;
            }
            if (!isset($this->estado)) {
                return 0;
            }
            if (!isset($this->descricaoProblema)) {
                return 0;
            }

            // Verifica se o usuário existe
            $existeUsuario = (new Usuario($this->idUsuario, null, null, null, null, null, null, null))->existe();
            if (!$existeUsuario) {
                return 0;
            }

            // Criação do array de objetos Equipamento associados a Solicitacao
            $equipamentos = array();

            foreach ($idsEquipamentos as $idEquipamento) {
                // Gera os objetos Equipamento relacionados
                $equipamento = new Equipamento($idEquipamento, null, null, null);

                // Verifica se o equipamento existe
                if ($equipamento->existe()) {
                    $equipamentos[] = $equipamento->consultar();
                } else {
                    return 0;
                }
            }

            // Inicia a transação que só irá terminar com a inserção de todos os objetos EquipamentoSolicitacao
            $conexao->beginTransaction();

            // SQL de inserção na tabela Solicitacao
            $sqlInsercaoSolicitacao  = "insert into solicitacao (id_usuario, estado, descricao_problema, data_hora_solicitacao) ";
            $sqlInsercaoSolicitacao .= "values (:idUsuario, :estado, :descricaoProblema, now());";

            // Inserção na tabela Solicitação
            $declaracaoSolicitacao = $conexao->prepare($sqlInsercaoSolicitacao);
            $insercaoSolicitacaoOK = $declaracaoSolicitacao->execute(
                array(
                    ":idUsuario"           => $this->idUsuario,
                    ":estado"              => $this->estado,
                    ":descricaoProblema"   => $this->descricaoProblema,
                )
            );

            // Se a inserção de Solicitacao deu errado, rollback e cancelar
            if (!$insercaoSolicitacaoOK) {
                $conexao->rollBack();
                return 0;
            }

            // Continue a transação \/ \/ \/

            // Inserção dos objetos EquipamentoSolicitacao            
            $linhasAfetadasEquipamentoSolicitacao = 0;
            foreach ($equipamentos as $equipamento) {
                $equipamentoSolicitacao = new EquipamentoSolicitacao(null, $this->id, $equipamento->getId());
                // Insere o objeto EquipamentoSolicitacao na tela correspondente
                $linhasAfetadas = $equipamentoSolicitacao->inserir();
                // Se deu algum erro na inserção
                if ($linhasAfetadas == 0) {
                    // Rollback e return
                    $conexao->rollBack();
                    return 0;
                } else {
                    $linhasAfetadasEquipamentoSolicitacao += $linhasAfetadas;
                }
            }

            // Commita a transação
            $conexao->commit();

            return $declaracaoSolicitacao->rowCount() + $linhasAfetadasEquipamentoSolicitacao;
        } catch (PDOException $e) {
            $conexao->rollBack();
            var_dump($e);
        }
    }

    public function existe()
    {
        $conexao = Conexao::get();
        try {
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
