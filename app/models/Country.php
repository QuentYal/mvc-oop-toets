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
    $this->db->query("SELECT * FROM `RichestPeople`;");

    $result = $this->db->resultSet();

    return $result;
  }

  public function getSingleRich($id)
  {
    $this->db->query("SELECT * FROM RichestPeople WHERE id = :id");
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
  }

  public function deleteCountry($id)
  {
    $this->db->query("DELETE FROM RichestPeople WHERE id = :id");
    $this->db->bind("id", $id, PDO::PARAM_INT);
    return $this->db->execute();
  }
}
