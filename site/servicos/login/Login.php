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
        try {
            // TODO: Checar se o usuário está ativo            
            $usuario = new Usuario(null, null, null, null, null, $this->usuario, $this->senha, null);
            $resultado = array();
            $resultado['existe'] = $usuario->existe();
            $resultado['ativo'] = $usuario->ativo();
            return $resultado;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
