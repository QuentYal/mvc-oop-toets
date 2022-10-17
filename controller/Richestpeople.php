<?php
class Richpeople extends Controller
{

    public function __construct()
    {
        $this->richModel = $this->model('Rich');
    }

    public function index()
    {
        /**
         * Haal via de method getFruits() uit de model Fruit de records op
         * uit de database
         */
        $richpeople = $this->richModel->getCountries();

        /**
         * Maak de inhoud voor de tbody in de view
         */
        $rows = '';
        foreach ($richpeople as $value) {
            $rows .= "<tr>
                  <td>$value->id</td>
                  <td>" . htmlentities($value->Name, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . number_format($value->NetWorth, 0, ',', '.') . "</td>
                  <td>" . number_format($value->Age, 0, ',', '.') . "</td>
                  <td>" . htmlentities($value->MyCompany, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td><a href='" . URLROOT . "/countries/delete/$value->id'>delete</a></td>
                </tr>";
        }


        $data = [
            'title' => '<h1>Rijke mensen</h1>',
            'Rich' => $rows
        ];
        $this->view('view/index', $data);
    }

    public function delete($id)
    {
        $this->RichModel->deleteRichPerson($id);

        $data = [
            'deleteStatus' => "Het record met id = $id is verwijdert."
        ];
        $this->view("view/delete", $data);
        header("Refresh:2; url=" . URLROOT . "/view/index");
    }
}
