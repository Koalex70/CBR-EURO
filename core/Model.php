<?php

class Model
{

    protected $dbh;

    public function __construct()
    {
        /* Подключение к базе данных MySQL с помощью вызова драйвера */
        $dsn = 'mysql:host=127.0.0.1';
        $user = 'root';
        $password = '1q2w3e4r';
        $dbname = 'test';

        try {
            $this->dbh = new PDO($dsn, $user, $password);
            $this->dbh->query(
                'CREATE DATABASE IF NOT EXISTS ' . $dbname . ';' .
                "CREATE USER IF NOT EXISTS '$user'@'localhost' IDENTIFIED BY '$password';
            GRANT ALL ON `$dbname`.* TO '$user'@'localhost';
            FLUSH PRIVILEGES;"
            );
            $this->dbh = new PDO($dsn . ';dbname=' . $dbname, $user, $password);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }
}