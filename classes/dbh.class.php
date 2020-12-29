<?php

class Dbh
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbName = 'visma_praktika';

    protected function connect()
    {
        // Setting dsn
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        // Making connection to db
        $pdo = new PDO($dsn, $this->user, $this->password);
        // Setting default data type for fetching data
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;

    }
}
