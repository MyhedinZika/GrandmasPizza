<?PHP
include('../includes/session.php');
require_once '../includes/class.user.php';


$user_login = new USER();
ob_start();
?>
<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Daily Offer - GrandmasPizza Admin</title>

  <link rel="stylesheet" type="text/css" href="ui/css/admin.css"/>

</head>


<body>
<?php


if ($user_login->is_logged_in())
{
$userId = $_SESSION['userSession'];
$user = $session->getUser($userId);
if ($user['userAdmin'] == 1)
{


?>
<div id="header" class="page-header">
  <a href="frontPage.php" class="logo-home">
    <img id="logo" src="../ui/images/logo.png" alt="Grandmas Pizza"/>
  </a>

  <h1>Grandmas Pizza Administration</h1>


  <div class="navbar">
    <ul class="nav">
      <li class="right"><a href="../" target="_blank">View Live Site</a></li>

      <li><a href="list-pizzas.php">Pizzas</a></li>
      <!-- <li><a href="index.php?action=manageotherfood">Other Food</a></li>
      <li><a href="index.php?action=managedrinks">Drinks</a></li>
      <li><a href="imagelibrary.php?type=relprod">Image Library</a></li> -->
      <li><a href="list-gallery-images.php">Image Library</a></li>
      <li class="active"><a href="list-dailyoffers.php">Daily Offers</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">

  <h2>Add Daily Offer</h2>

  <form class="admin-form" method="post" action="../includes/process.php" enctype="multipart/form-data">
    <fieldset>
      <legend>Details</legend>

      <ul>
        <li>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name"/>
        </li>
        <li>
          <?php
          $pizzas = $session->getPizzas();
          echo '<label for="pizza">Pizza:</label>';
          echo '<select name="pizza" id="pizza">';
          foreach ($pizzas as $key => $value) {
            echo '<option value="' . $value['p_id'] . '">' . $value['p_name'] . '</option>';
          }
          echo '</select>';
          ?>
        </li>

        <li>
          <?php
          $sizes = $session->getSizes();
          echo '<label for="size">Pizza Size:</label>';
          echo '<select name="size" id="size">';
          foreach ($sizes as $key => $value) {
            echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
          }
          echo '</select>';
          ?>
        </li>
        <li>
          <?php
          $drinks = $session->getDrinks();
          echo '<label for="drink">Drink:</label>';
          echo '<select name="drink" id="drink">';
          foreach ($drinks as $key => $value) {
            echo '<option value="' . $value['D_id'] . '">' . $value['D_Name'] . '</option>';
          }
          echo '</select>';
          ?>
        </li>


      </ul>
    </fieldset>


    <fieldset>
      <legend>Price</legend>
      <ul>


        <li>
          <label for="price-dailyOffer">Daily Offer Price:</label>
          <input type="text" id="price-dailyOffer" name="price-dailyOffer"/>
        </li>


      </ul>
    </fieldset>


    <div class="buttons">
      <button type="submit" class="button icon go" title="Submit" value="addDailyOffer" name="action">Submit</button>
      <a class="button icon cancel" title="Cancel" href="../admin/add-pizza.php">Cancel</a>
    </div>

  </form>

  <?php }
  else {
    $user_login->redirect('../index.php');
  }
  }
  else {
    //ob_end();
    $user_login->redirect('../index.php');
    echo "test";

    //header("Location: ../../index.php" );
    //exit();


  }
  ?>

</div><!-- /.page-body -->

</body>
</html>

