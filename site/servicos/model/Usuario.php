<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class Usuario
{
    // Atributos
    private $id;
    private $idSetor;
    private $idFuncao;
    private $idNivelAcesso;
    private $nome;
    private $usuario;
    private $senha;
    private $ativo;

    // Construtor
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

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getIdSetor()
    {
        return $this->idSetor;
    }

    public function getIdFuncao()
    {
        return $this->idFuncao;
    }

    public function getIdNivelAcesso()
    {
        return $this->idNivelAcesso;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    // Métodos concretos
    public function inserir()
    {
        $conexao = Conexao::get();
        try {
            // Checa consistência das variáveis
            if (!isset($this->idSetor)) {
                return array("erro" => "idSetor não informado");
            }
            if (!isset($this->idFuncao)) {
                return array("erro" => "idFuncao não informado");
            }
            if (!isset($this->idNivelAcesso)) {
                return array("erro" => "idNivelAcesso não informado");
            }
            if (!isset($this->nome)) {
                return array("erro" => "nome não informado");
            }
            if (!isset($this->usuario)) {
                return array("erro" => "usuario não informado");
            }
            if (!isset($this->senha)) {
                return array("erro" => "senha não informado");
            }
            if (!isset($this->ativo)) {
                return array("erro" => "ativo não informado");
            }

            //Inicia a transação
            $conexao->beginTransaction();

            // Prepara uma inserção SQL retornando uma declaração
            $sql  = "insert into usuario (id_setor, id_funcao, id_nivel_acesso, nome, usuario, senha, ativo) ";
            $sql .= "values (:idSetor, :idFuncao, :idNivelAcesso, :nome, :usuario, :senha, :ativo);";
            $declaracao = $conexao->prepare($sql);

            // Executa a declaração e retorna flag de sucesso
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
                // Se deu certo, retorna sucesso
                $conexao->commit();
                return array("sucesso" => $declaracao->rowCount());
            } else {
                // Senão, dá rollback e retorna o erro                
                $conexao->rollBack();
                return array("erro" => "Não foi possível inserir o Usuario");
            }
        } catch (PDOException $e) {
            // catch dá rollback e retorna erro
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function verificarPermissaoParaLogar()
    {
        $conexao = Conexao::get();
        try {
            // Checa consistencia das variaveis
            if (!isset($this->usuario)) {
                return array("erro" => "usuario não informado");
            }
            if (!isset($this->senha)) {
                return array("erro" => "senha não informado");
            }

            // Checa se existe
            $declaracao = $conexao->prepare("select * from usuario where usuario = :usuario and senha = :senha;");
            $declaracao->execute(
                array(
                    ":usuario" => $this->usuario,
                    ":senha"   => $this->senha
                )
            );
            $existe = $declaracao->rowCount() > 0;

            // Checa se está ativo
            $declaracao = $conexao->prepare("select * from usuario where usuario = :usuario and senha = :senha and ativo = 1;");
            $declaracao->execute(
                array(
                    ":usuario" => $this->usuario,
                    ":senha"   => $this->senha
                )
            );
            $ativo = $declaracao->rowCount() > 0;

            return array(
                "existe" => $existe,
                "ativo"  => $ativo
            );
        } catch (PDOException $e) {
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
            $declaracao = $conexao->prepare("update usuario set ativo = :ativo where id = :id");
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
                return array("erro" => "update de Usuario falhou");
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
            $declaracao = $conexao->prepare("select * from usuario where id = :id");

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
                return array("erro" => "Não foi encontrado Usuário com o ID {$this->id}");
            } else {
                // Senão, retornar Equipamento
                $usuario = new Usuario(
                    $this->id,
                    $busca['id_setor'],
                    $busca['id_funcao'],
                    $busca['id_nivel_acesso'],
                    $busca['nome'],
                    $busca['usuario'],
                    $busca['senha'],
                    $busca['ativo'],
                );
                return array("usuario" => $usuario);
            }
        } catch (PDOException $e) {
            // catch retorna erro            
            return array("erro" => $e);
        }
    }

    public function consultarTodos()
    {
        $conexao = Conexao::get();
        try {
            $declaracao = $conexao->prepare("select * from usuario;");
            $declaracao->execute();
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "não foi possível retornar os Usuarios");
            } else {
                $usuarios = array();
                foreach ($busca as $linha) {
                    $usuarios[] = new Usuario(
                        $linha['id'],
                        $linha['id_setor'],
                        $linha['id_funcao'],
                        $linha['id_nivel_acesso'],
                        $linha['nome'],
                        $linha['usuario'],
                        $linha['senha'],
                        $linha['ativo']
                    );
                }
                return array("usuarios" => $usuarios);
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }
}
