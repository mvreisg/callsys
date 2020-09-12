<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class Solicitacao
{
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

    public function inserir($equipamentos)
    {
        $conexao = Conexao::get();
        try {
            $existeUsuario = (new Usuario($this->idUsuario, null, null, null, null, null, null, null))->existe();
            if (!$existeUsuario) {
                return 0;
            }
            foreach ($equipamentos as $equipamento) {
                
            }
            // TODO: Verificar consistência dos dados
            $sqlInsercao  = "insert into solicitacao (id_usuario, estado, descricao_problema, data_hora_solicitacao) ";
            $sqlInsercao .= "values (:idUsuario, :estado, :descricaoProblema, now());";
            $conexao->beginTransaction();
            $declaracao = $conexao->prepare($sqlInsercao);
            $deuCerto = $declaracao->execute(
                array(
                    ":idUsuario"           => $this->idUsuario,
                    ":estado"              => $this->estado,
                    ":descricaoProblema"   => $this->descricaoProblema,
                )
            );
            if ($deuCerto) {
                $conexao->commit();
            } else {
                $conexao->rollBack();
            }
            return $declaracao->rowCount();
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
