<?php
class Countries extends Controller
{

    public function __construct()
    {
        $this->countryModel = $this->model('Country');
    }

    public function index()
    {
        /**
         * Haal via de method getFruits() uit de model Fruit de records op
         * uit de database
         */
        $countries = $this->countryModel->getCountries();

        /**
         * Maak de inhoud voor de tbody in de view
         */
        $rows = '';
        foreach ($countries as $value) {
            $rows .= "<tr>
                  <td>$value->id</td>
                  <td>" . htmlentities($value->name, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->capitalCity, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->continent, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . number_format($value->population, 0, ',', '.') . "</td>
                  <td><a href='" . URLROOT . "/countries/update/$value->id'>update</a></td>
                  <td><a href='" . URLROOT . "/countries/delete/$value->id'>delete</a></td>
                </tr>";
        }


        $data = [
            'title' => '<h1>Landenoverzicht</h1>',
            'countries' => $rows
        ];
        $this->view('countries/index', $data);
    }

    public function update($id = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->countryModel->updateCountry($_POST);
            header("Location: " . URLROOT . "/countries/index");
        } else {
            $row = $this->countryModel->getSingleCountry($id);
            $data = [
                'title' => '<h1>Update landenoverzicht</h1>',
                'row' => $row
            ];
            $this->view("countries/update", $data);
        }
    }

    public function delete($id)
    {
        $this->countryModel->deleteCountry($id);

        $data = [
            'deleteStatus' => "Het record met id = $id is verwijdert."
        ];
        $this->view("countries/delete", $data);
        header("Refresh:2; url=" . URLROOT . "/countries/index");
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //var_dump($_SERVER["REQUEST_METHOD"]);
            try {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $this->countryModel->createCountry($_POST);

                header("Location:" . URLROOT . "/countries/index");
            } catch (PDOException $e) {
                echo "Het inserten van het record is niet gelukt";
                header("Refresh:3; url=" . URLROOT . "/countries/index");
            }
        } else {
            $data = [
                'title' => "voeg een nieuw land in"
            ];

            $this->view("countries/create", $data);
        }
    }
}
