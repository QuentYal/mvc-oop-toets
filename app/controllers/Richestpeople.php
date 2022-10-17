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
                  <td>" . number_format($value->population, 0, ',', '.') . "</td>
                  <td>" . number_format($value->population, 0, ',', '.') . "</td>
                  <td>" . htmlentities($value->capitalCity, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td><a href='" . URLROOT . "/rich/delete/$value->id'>delete</a></td>
                </tr>";
    }


    $data = [
      'title' => '<h1>richpeople</h1>',
      'rich' => $rows
    ];
    $this->view('countries/index', $data);
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
}
