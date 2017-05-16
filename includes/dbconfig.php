<?php

class Database
{

  private $host = "mysql.grandmaspizza.online-presence.com";
  private $db_name = "grandmaspizza";
  private $username = "gr4ndm45";
  private $password = "P!z2z2a00";
  public $connection;

  public function dbConnection()
  {

    $this->connection = null;
    try {
      $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
      echo "Connection error: " . $exception->getMessage();
    }

    return $this->connection;
  }
}

?>