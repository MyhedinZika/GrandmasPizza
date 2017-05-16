<?php

include("constants.php");

class MySQLDB
{
  public $connection;         //The MySQL database connection

  /* Class constructor */
  function __construct()
  {
    /* Make connection to database */
    try {
      # MySQL with PDO_MYSQL
      $this->connection = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    } catch (PDOException $e) {
      echo "Error connecting to database.";
    }

  } // MySQLDB function
}

/* Create database connection */
$database = new MySQLDB;
?>