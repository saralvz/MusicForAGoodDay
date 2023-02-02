<?php

namespace Database\PDO;

class Connection
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $this->make_connection();
    }

    //PATRON DE DISEÑO SINGLETON
    public static function getInstance()
    {
        if (!self::$instance instanceof self)
            self::$instance = new self();
        return self::$instance;
    }

    private function make_connection()
    {
        $server = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'music_db';

        // CONNECTION
        try {
            $connectionPDO = new \PDO("mysql:host=$server;dbname=$database", $username, $password);
            $setnames = $connectionPDO->prepare("SET NAMES 'utf8'");
            $setnames->execute();
            $this->connection = $connectionPDO;
            // var_dump($setnames);
            echo "Conexión exitosa a la base de datos $database";
        } catch (\PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    }

    public function get_instance_database()
    {
        return $this->connection;
    }
}


$db = Connection::getInstance();
$conn = $db->get_instance_database();