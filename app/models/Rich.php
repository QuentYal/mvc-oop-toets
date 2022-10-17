<?php
class Rich
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getRich()
  {
    $this->db->query("SELECT * FROM `richestpeople`;");

    $result = $this->db->resultSet();

    return $result;
  }

  public function getSingleRich($id)
  {
    $this->db->query("SELECT * FROM richestpeople WHERE id = :id");
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
  }

  public function deleteCountry($id)
  {
    $this->db->query("DELETE FROM richestpeople WHERE id = :id");
    $this->db->bind("id", $id, PDO::PARAM_INT);
    return $this->db->execute();
  }
}
