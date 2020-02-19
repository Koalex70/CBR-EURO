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

    public function migrate()
    {
        $this->dbh->query('CREATE TABLE rates (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id));');
        $this->dbh->query('CREATE TABLE links (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id));');

        if (empty($this->GetCBRLink())) {
            $this->AddCBRLink();
        }
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