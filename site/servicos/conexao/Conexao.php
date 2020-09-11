<?php
class Conexao
{

    //Data Source Name, necessário para conectar com o banco
    //possui o nome do banco e do host
    private const DSN = "mysql:dbname=callsys;host=127.0.0.1";
    private const USUARIO = "root";
    private const SENHA = "";

    public static function get()
    {
        try {
            return new PDO(self::DSN, self::USUARIO, self::SENHA);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
