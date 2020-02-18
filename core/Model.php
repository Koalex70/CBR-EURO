<?php

class Model
{

    protected $dbh;

    public function __construct()
    {
        /* Подключение к базе данных MySQL с помощью вызова драйвера */
        $dsn = 'mysql:dbname=rate;host=127.0.0.1';
        $user = 'root';
        $password = '1q2w3e4r';

        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }
}