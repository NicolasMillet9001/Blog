<?php

//use back\config\Database ;

class User
{
    // Properties
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }

    // Methods
    public function getAll()
    {
        $query = $this->pdo->query('SELECT * FROM users');
        $users = $query->fetchAll();

        return $users;
    }

    public function getOne(int $id)
    {
        $query = $this->pdo->prepare("SELECT users.id, firstname, lastname, email, created_at, label FROM users JOIN roles ON users.role_id = roles.id WHERE users.id = ?");
        $query->execute([$id]);

        return $query->fetch();
    }
}