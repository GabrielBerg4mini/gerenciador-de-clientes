<?php



class Database
{
    private $host = "localhost";
    private $dbName = "gerenciador-de-clientes";
    private $userName = "root";
    private $password = "";
    private $connection;


    public function getConnection()
    {
        $this->connection = null;
        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exeption) {
            echo "Connection error:" . $exeption->getMessage();
        }
        return $this->connection;
    }
}
