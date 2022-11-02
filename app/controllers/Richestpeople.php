<?php
class Richestpeople extends Controller
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
    $richest = $this->richModel->getRich();

    /**
     * Maak de inhoud voor de tbody in de view
     */
    $rows = '';
    foreach ($richest as $value) {
      $rows .= "<tr>
                  <td>$value->Id</td>
                  <td>" . htmlentities($value->Name, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . number_format($value->NetWorth, 0, ',', '.') . "</td>
                  <td>" . number_format($value->Age, 0, ',', '.') . "</td>
                  <td>" . htmlentities($value->MyCompany, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td><a href='" . URLROOT . "/Richestpeople/delete/$value->Id'>delete</a></td>
                </tr>";
    }


    $data = [
      'title' => '<h1>richpeople</h1>',
      'richestpeople' => $rows
    ];
    $this->view('rich/index', $data);
  }

  public function delete($id)
  {
    $this->richModel->deleteRich($id);

    $data = [
      'deleteStatus' => "Het record met id = $id is verwijdert."
    ];
    $this->view("rich/delete", $data);
    header("Refresh:2; url=" . URLROOT . "/rich/index");
  }
}
