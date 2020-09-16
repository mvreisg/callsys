<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/estagio/site/servicos/conexao/Conexao.php";

class NivelAcesso
{
    // Atributos
    private $id;
    private $nome;
    private $ativo;

    // Construtor
    public function __construct($id, $nome, $ativo)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    // Métodos concretos
    public function inserir()
    {
        // Pega o objeto de conexão com o banco
        $conexao = Conexao::get();
        try {
            // Inicia a transação
            $conexao->beginTransaction();

            // Prepara uma inserção no banco, retornando uma declaração
            $declaracao = $conexao->prepare("insert into nivel_acesso (nome, ativo) values (:nome, :ativo);");

            // Executa a declaração, retornando flag de sucesso
            $deuCerto = $declaracao->execute(
                array(
                    ":nome"  => $this->nome,
                    ":ativo" => $this->ativo
                )
            );
            if ($deuCerto) {
                // Se deu certo, commite e retorne chave de sucesso
                $conexao->commit();
                return array("sucesso" => $declaracao->rowCount());
            } else {
                // Senão, rollback e retorna erro
                $conexao->rollBack();
                return array("erro" => "Não foi possível inserir o Nível de Acesso");
            }
        } catch (PDOException $e) {
            // catch dá rollback e retorna erro
            $conexao->rollBack();
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
            $declaracao = $conexao->prepare("update nivel_acesso set ativo = :ativo where id = :id");
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
                return array("erro" => "Não foi possível alterar o Nível de Acesso");
            }
        } catch (PDOException $e) {
            // catch retorna erro
            $conexao->rollBack();
            return array("erro" => $e);
        }
    }

    public function consultarPorNome()
    {
        if (!isset($this->nome)) {
            return array("erro" => "nome não informado");
        }

        // Pega o objeto estático de Conexao
        $conexao = Conexao::get();
        try {
            $declaracao = $conexao->prepare("select * from nivel_acesso where nome like '{$this->nome}%'");
            $declaracao->execute();
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);
            if (!$busca) {
                return array("erro" => "Não foi encontrado nenhum nível de acesso com o nome {$this->nome}");
            } else {
                $niveisAcesso = array();
                foreach ($busca as $linha) {
                    $niveisAcesso[] = new NivelAcesso(
                        $linha['id'],
                        $linha['nome'],
                        $linha['ativo']
                    );
                }
                return array("niveis_acesso" => $niveisAcesso);
            }
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }

    public function consultarTodos()
    {
        // Pega o objeto de conexão com o banco
        $conexao = Conexao::get();
        try {
            // Prepara uma consulta ao banco, retornando uma declaração            
            $declaracao = $conexao->prepare("select * from nivel_acesso");

            // Executa a declaração
            $declaracao->execute();

            // Retorna a busca
            $busca = $declaracao->fetchAll(PDO::FETCH_ASSOC);

            // Checa se a busca deu certo
            if (!$busca) {
                // Se não deu certo, retorne o erro
                return array("erro" => "Erro ao buscar todos os Níveis de Acesso");
            } else {
                // Se deu certo, 
                // Preencha o array de objetos Nivel_Acesso
                $niveis_acesso = array();
                foreach ($busca as $nivel_acesso) {
                    $niveis_acesso[] = new NivelAcesso(
                        $nivel_acesso['id'],
                        $nivel_acesso['nome'],
                        $nivel_acesso['ativo']
                    );
                }
                // Retorna um array com os objetos nivel_acesso associados a uma chave 'niveis_acesso'
                return array("niveis_acesso" => $niveis_acesso);
            }
        } catch (PDOException $e) {
            // catch retorna erro
            return array("erro" => $e);
        }
    }
}
