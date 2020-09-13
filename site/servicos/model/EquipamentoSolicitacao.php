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
            $sqlInsercao  = "insert into equipamento_solicitacao (id_solicitacao, id_equipamento) ";
            $sqlInsercao .= "values (:idSolicitacao, :idEquipamento);";
            $declaracao = $conexao->prepare($sqlInsercao);
            $declaracao->execute(
                array(
                    ":idSolicitacao" => $this->idSolicitacao,
                    ":idEquipamento" => $this->idEquipamento
                )
            );
            return $declaracao->rowCount();
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
