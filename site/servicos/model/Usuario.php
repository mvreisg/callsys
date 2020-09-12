<?php
require_once "../../conexao/Conexao.php";

class Usuario
{
    private $id;
    private $idSetor;
    private $idFuncao;
    private $idNivelAcesso;
    private $nome;
    private $usuario;
    private $senha;
    private $ativo;

    public function __construct($id, $idSetor, $idFuncao, $idNivelAcesso, $nome, $usuario, $senha, $ativo)
    {
        $this->id = $id;
        $this->idSetor = $idSetor;
        $this->idFuncao = $idFuncao;
        $this->idNivelAcesso = $idNivelAcesso;
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->ativo = $ativo;
    }

    public function inserir()
    {
        $conexao = Conexao::get();
        try {
            // TODO: Checar se usuário já existe
            $sqlInsercao  = "insert into usuario (id_setor, id_funcao, id_nivel_acesso, nome, usuario, senha, ativo) ";
            $sqlInsercao .= "values (:idSetor, :idFuncao, :idNivelAcesso, :nome, :usuario, :senha, :ativo);";
            $conexao->beginTransaction();
            $declaracao = $conexao->prepare($sqlInsercao);
            $deuCerto = $declaracao->execute(
                array(
                    ":idSetor"       => $this->idSetor,
                    ":idFuncao"      => $this->idSetor,
                    ":idNivelAcesso" => $this->idNivelAcesso,
                    ":nome"          => $this->nome,
                    ":usuario"       => $this->usuario,
                    ":senha"         => $this->senha,
                    ":ativo"         => $this->ativo,
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
}
