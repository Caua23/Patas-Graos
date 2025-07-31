<?php

class Database
{
    private $connection;
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    private function connect()
    {
        $this->connection = new PDO(
            'mysql:host=' . getenv('MYSQL_SERVER') .
            ';port=' . getenv('MYSQL_PORT') .
            ';dbname=' . getenv('MYSQL_DATABASE') .
            ';charset=' . getenv('MYSQL_CHARSET'),
            getenv('MYSQL_USER'),
            getenv('MYSQL_PASS'),
            [PDO::ATTR_PERSISTENT => true]
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function disconnect()
    {
        $this->connection = null;
    }

    public function select($sql, $parameters = [], $mode = PDO::FETCH_ASSOC)
    {
        if (!preg_match('/^SELECT/i', $sql)) {
            throw new Exception('A instrução fornecida não é um SELECT válido.');
        }

        return $this->executeFetch($sql, $parameters, $mode);
    }

    public function insert($sql, $parameters = [])
    {
        if (!preg_match('/^INSERT/i', $sql)) {
            throw new Exception('A instrução fornecida não é um INSERT válido.');
        }

        return $this->execute($sql, $parameters);
    }

    public function update($sql, $parameters = [])
    {
        if (!preg_match('/^UPDATE/i', $sql)) {
            throw new Exception('A instrução fornecida não é um UPDATE válido.');
        }

        return $this->execute($sql, $parameters);
    }

    public function delete($sql, $parameters = [])
    {
        if (!preg_match('/^DELETE/i', $sql)) {
            throw new Exception('A instrução fornecida não é um DELETE válido.');
        }

        return $this->execute($sql, $parameters);
    }

    public function statement($sql, $parameters = [])
    {
        if (preg_match('/^(SELECT|INSERT|UPDATE|DELETE)/i', $sql)) {
            throw new Exception('statement() é apenas para comandos genéricos como CREATE, DROP, etc.');
        }

        return $this->execute($sql, $parameters);
    }

    private function execute($sql, $parameters = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($parameters);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    private function executeFetch($sql, $parameters = [], $mode = PDO::FETCH_ASSOC)
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($parameters);
            return $stmt->fetchAll($mode);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
