<?php

class Model_Main extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ReturnValueOrNullByDate($date)
    {
        $statement = $this->dbh->prepare('SELECT value FROM rates WHERE date = :date');

        $statement->execute([
            ':date' => $date
        ]);

        return $statement->fetchColumn();
    }

    public function AddNewRate($date, $value)
    {
        $sth = $this->dbh->prepare("INSERT INTO `rates` SET `date` = :date, `value` = :value");

        $sth->execute([
            ':date' => $date,
            ':value' => $value,
        ]);
    }

    public function AddCBRLink()
    {
        $sth = $this->dbh->prepare("INSERT INTO `links` SET `value` = :value");

        $sth->execute([
            ':value' => 'http://www.cbr.ru/scripts/XML_daily.asp?date_req='
        ]);
    }

    public function GetCBRLink()
    {
        $statement = $this->dbh->prepare('SELECT * FROM links WHERE id = :id');

        $statement->execute([
            ':id' => 1
        ]);

        return $statement->fetchAll();
    }
}