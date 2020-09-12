<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

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
            if ($this->existe()) {
                return 0;
            }
            // TODO: Checar valores das variáveis            
            $sqlInsercao  = "insert into usuario (id_setor, id_funcao, id_nivel_acesso, nome, usuario, senha, ativo) ";
            $sqlInsercao .= "values (:idSetor, :idFuncao, :idNivelAcesso, :nome, :usuario, :senha, :ativo);";
            $conexao->beginTransaction();
            $declaracao = $conexao->prepare($sqlInsercao);
            $deuCerto = $declaracao->execute(
                array(
                    ":idSetor"       => $this->idSetor,
                    ":idFuncao"      => $this->idFuncao,
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

    public function existe()
    {
        $conexao = Conexao::get();
        try {
            // TODO: Checar valores das variáveis
            $sqlSelectTodos = "select * from usuario where usuario = :usuario and senha = :senha";
            $declaracao = $conexao->prepare($sqlSelectTodos);
            $declaracao->execute(
                array(
                    ":usuario" => $this->usuario,
                    ":senha"   => $this->senha
                )
            );
            return $declaracao->rowCount() > 0;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function ativo()
    {
        $conexao = Conexao::get();
        try {
            // TODO: Checar valores das variáveis
            $sqlSelectAtivo = "select * from usuario where usuario = :usuario and senha = :senha and ativo = 1;";
            $declaracao = $conexao->prepare($sqlSelectAtivo);
            $declaracao->execute(
                array(
                    ":usuario" => $this->usuario,
                    ":senha"   => $this->senha
                )
            );
            return $declaracao->rowCount() > 0;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function consultarTodos()
    {
        $conexao = Conexao::get();
        try {
            $sqlSelectTodos = "select * from usuario";
            $declaracao = $conexao->prepare($sqlSelectTodos);
            $declaracao->execute();
            return $declaracao->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
