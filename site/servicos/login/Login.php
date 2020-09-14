<?php
require_once "../model/Usuario.php";

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
            $usuario = new Usuario(null, null, null, null, null, $this->usuario, $this->senha, null);
            return $usuario->autenticar();
        } catch (PDOException $e) {
            return array("erro" => $e);
        }
    }
}
