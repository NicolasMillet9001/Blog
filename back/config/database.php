<?php


class Database
{
    // Properties
    private string $host = 'localhost';
    private string $database = 'tp1';
    private string $username = 'root';
    private string $password = 'user';

    public function getPdo()
    {
        try {
            $pdo = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password);
        } catch (\PDOException $error) {
            var_dump($error);
            die();
        }

        return $pdo;
    }
}