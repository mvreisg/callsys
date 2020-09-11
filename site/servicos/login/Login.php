<?php
require_once "../../servicos/conexao/Conexao.php";

class Login
{
    private $usuario;
    private $senha;

    public function __construct($usuario, $senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    public function login()
    {
        $conexao = Conexao::get();
        try {
            // TODO: Checar se o usuário está ativo
            $sqlSelect = "select * from usuario where usuario = '$this->usuario' and senha = '$this->senha';";
            $query = $conexao->query($sqlSelect);
            //retorna a quantidade de linhas encontradas
            return $query->rowCount();
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
