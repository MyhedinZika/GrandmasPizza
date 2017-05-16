<?php

if (!(isset($extra))) {
  $extra = "";
}


if (preg_match("/online-presence/", $_SERVER['HTTP_HOST'])) {
  define("DEBUG_STATUS", 0);
  define("FOLDER", "");
  define("BASE_URL", "http://grandmaspizza.online-presence.com/" . FOLDER);
  define("BASE_DIR", "/home/xxxx/yyyy/" . FOLDER);  // put filepath to the site here
  define("ADMIN_URL", BASE_URL . "admin/");

  $DATABASE_HOST = "mysql.online-presence.com";
  $DATABASE_USER = "myhedin";
  $DATABASE_PASSWORD = "xyz";
  $DATABASE_NAME = "grandmaspizza";

  define("SITE_TYPE", "live");

} else if (preg_match("/127.0.0.1/", $_SERVER['HTTP_HOST'])) {
  ini_set('display_errors', 1);
  //ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  define("DEBUG_STATUS", 1);
  define("FOLDER", "myhedin/pizza-j");
  define("BASE_URL", "http://127.0.0.1/" . FOLDER);
  define("BASE_DIR", "c:/wamp/www/" . FOLDER);
  define("ADMIN_URL", BASE_URL . "admin/");

  $DATABASE_HOST = "localhost";
  $DATABASE_USER = "root";
  $DATABASE_PASSWORD = "";
  $DATABASE_NAME = "pizza";

  define("SITE_TYPE", "local");

} else if (preg_match("/localhost/", $_SERVER['HTTP_HOST'])) {
  ini_set('display_errors', 1);
  //ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  define("DEBUG_STATUS", 1);
  define("FOLDER", "myhedin/pizza-j");
  define("BASE_URL", "http://localhost/" . FOLDER);
  define("BASE_DIR", "c:/wamp/www/" . FOLDER);
  define("ADMIN_URL", BASE_URL . "admin/");

  $DATABASE_HOST = "localhost";
  $DATABASE_USER = "root";
  $DATABASE_PASSWORD = "";
  $DATABASE_NAME = "pizza";

  define("SITE_TYPE", "local");

}
require_once($extra . "classes/class_dbConnection.php");

?>