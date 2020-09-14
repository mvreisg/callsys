<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class EquipamentoSolicitacao
{
    private $id;
    private $idSolicitacao;
    private $idEquipamento;

    public function __construct($id, $idSolicitacao, $idEquipamento)
    {
        $this->id = $id;
        $this->idSolicitacao = $idSolicitacao;
        $this->idEquipamento = $idEquipamento;
    }

    public function inserir()
    {
        $conexao = Conexao::get();
        try {
            // Não se inicia transaction porque é inserido na transaction da Solicitação            

            // Checagem dos valores
            if (!isset($this->idSolicitacao)) {
                return array("erro" => "idSolicitacao não informado");
            }
            if (!isset($this->idEquipamento)) {
                return array("erro" => "idEquipamento não informado");
            }

            $sql  = "insert into equipamento_solicitacao (id_solicitacao, id_equipamento) ";
            $sql .= "values (:idSolicitacao, :idEquipamento);";
            $declaracao = $conexao->prepare($sql);
            $ok = $declaracao->execute(
                array(
                    ":idSolicitacao" => $this->idSolicitacao,
                    ":idEquipamento" => $this->idEquipamento
                )
            );
            if (!$ok) {
                return array("erro" => "EquipamentoSolicitacao não inserido");
            }
            return array("sucesso" => $ok);
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }
}
