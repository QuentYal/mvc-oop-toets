<?php
class Richestpeople extends Controller
{

  public function __construct()
  {
    $this->RichModel = $this->model('Rich');
  }

  public function index()
  {
    /**
     * Haal via de method getFruits() uit de model Fruit de records op
     * uit de database
     */
    $Richest = $this->RichModel->getRich();

    /**
     * Maak de inhoud voor de tbody in de view
     */
    $rows = '';
    foreach ($Richest as $value) {
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
    $this->view('rich/index', $data);
  }

  public function delete($id)
  {
    $this->RichModel->deleteRich($id);

    $data = [
      'deleteStatus' => "Het record met id = $id is verwijdert."
    ];
    $this->view("rich/delete", $data);
    header("Refresh:2; url=" . URLROOT . "/rich/index");
  }
}
