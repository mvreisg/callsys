<?php
class Conexao
{

    //Data Source Name, necessário para conectar com o banco
    //possui o nome do banco e do host
    private const DSN = "mysql:dbname=callsys;host=127.0.0.1";
    private const USUARIO = "root";
    private const SENHA = "";

    private static $pdo;

    public static function get()
    {
        try {
            if (isset(self::$pdo)) {
                return self::$pdo;
            }
            self::$pdo = new PDO(self::DSN, self::USUARIO, self::SENHA);
            return self::$pdo;
        } catch (PDOException $e) {
            return null;
        }
    }
}
