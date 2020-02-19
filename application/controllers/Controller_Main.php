<?php

class Controller_Main extends Controller
{
    public $model;

    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    /**
     * Default action
     * @throws Exception
     */
    function action_index()
    {
        $this->model->migrate();

        $dateFrom = new DateTime();
        $dateFrom->modify('-1 day');

        $dateTo = new DateTime();

        $data['dateFrom'] = $dateFrom->format('d-m-Y');
        $data['dateTo'] = $dateTo->format('d-m-Y');

        $data['valueDateFrom'] = $this->takeFromDBOrXML($dateFrom);
        $data['valueDateTo'] = $this->takeFromDBOrXML($dateTo);

        $data['difference'] = $data['valueDateFrom'] - $data['valueDateTo'];

        $this->view->generate('main_view.php', 'template_view.php', $data);
    }

    /**
     * This action accepts and processes an ajax request.
     * @throws Exception
     */
    public function action_ajax()
    {
        if (isset($_POST['dateFrom']) && !empty($_POST['dateFrom']) && isset($_POST['dateTo']) && !empty($_POST['dateTo'])) {

            $dateFrom = new DateTime($_POST['dateFrom']);
            $dateTo = new DateTime($_POST['dateTo']);

            $valueDateFrom = $this->takeFromDBOrXML($dateFrom);
            $valueDateTo = $this->takeFromDBOrXML($dateTo);

            $difference = $valueDateFrom - $valueDateTo;

            echo json_encode([
                'success' => true,
                'dateFrom' => $_POST['dateFrom'],
                'valueDateFrom' => $valueDateFrom,
                'dateTo' => $_POST['dateTo'],
                'valueDateTo' => $valueDateTo,
                'difference' => $difference,
            ]);
        } else {
            echo json_encode([
                'error' => true
            ]);
        }
    }

    /**
     * This method searches for the euro exchange rate for the selected dates first in the database and
     * if there is no such entry, it parses the xml file for the selected date and puts the values ​​in the database
     * @param DateTime $date
     * @return mixed|string|string[]
     */
    private function takeFromDBOrXML(DateTime $date)
    {
        if (empty($valueDate = $this->model->ReturnValueOrNullByDate($date->format('Y-m-d')))) {
            $valueDate = $this->takeRateFromXML($this->convertDateType($date->format('d-m-Y')));
            $this->model->AddNewRate($date->format('Y-m-d'), $valueDate);
        }

        return $valueDate;
    }

    /**
     * This method parses an xml file
     * @param $date
     * @return string|string[]
     */
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

    /**
     * This method converts a date from one format to readable for xml file
     * @param $date
     * @return string|string[]
     */
    private function convertDateType($date)
    {
        return str_replace('-', '/', $date);
    }
}