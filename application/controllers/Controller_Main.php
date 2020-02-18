<?php

class Controller_Main extends Controller
{
    public $model;

    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    function action_index()
    {
        if (isset($_POST['dateFrom']) && !empty($_POST['dateFrom'])) {
            $dateFrom = new DateTime($_POST['dateFrom']);
        } else {
            $dateFrom = new DateTime();
            $dateFrom->modify('-1 day');
        }

        $dateTo = isset($_POST['dateTo']) && !empty($_POST['dateTo']) ? new DateTime($_POST['dateTo']) : new DateTime();

        $data['dateFrom'] = $dateFrom->format('d-m-Y');
        $data['dateTo'] = $dateTo->format('d-m-Y');

        if (!empty($valueDateFrom = $this->model->ReturnValueOrNullByDate($dateFrom->format('Y-m-d')))) {
            $data['valueDateFrom'] = $valueDateFrom;
        } else {
            $data['valueDateFrom'] = $this->takeRateFromXML($this->convertDateType($dateFrom->format('d-m-Y')));
            $this->model->AddNewRate($dateFrom->format('Y-m-d'), $data['valueDateFrom']);
        }

        if (!empty($valueDateTo = $this->model->ReturnValueOrNullByDate($dateTo->format('Y-m-d')))) {
            $data['valueDateTo'] = $valueDateTo;
        } else {
            $data['valueDateTo'] = $this->takeRateFromXML($this->convertDateType($dateTo->format('d-m-Y')));
            $this->model->AddNewRate($dateTo->format('Y-m-d'), $data['valueDateTo']);
        }

        $data['difference'] = $data['valueDateFrom'] - $data['valueDateTo'];

        $this->view->generate('main_view.php', 'template_view.php', $data);
    }

    private function takeRateFromXML($date)
    {
        $link = $this->model->GetCBRLink()[0]['value'];//Получаем ссылку на xml файл

        $languages = simplexml_load_file($link . $date); //валюты

        foreach ($languages->Valute as $lang) {
            if ($lang["ID"] == 'R01239') { //Код Евро
                return str_replace(',', '.', $lang->Value); //ее значение
            }
        }
    }

    private function convertDateType($date)
    {
        return str_replace('-', '/', $date);
    }
}