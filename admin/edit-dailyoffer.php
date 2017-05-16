<?php
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
  <title>Edit Daily Offer - GrandmasPizza Admin</title>

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

      <li><a href="list-pizzas.php">Pizzas</a>
        <ul class="subnav">
          <li><a href="list-categories.php">Categories</a></li>
          <li><a href="list-ingredients.php">Ingredients</a></li>
          <li><a href="list-sizes.php">Sizes</a></li>
        </ul>
      </li>

      <li><a href="imagelibrary.php?type=relprod">Image Library</a></li>
      <li class="active"><a href="list-dailyoffers.php">Daily Offers</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">
  <?php

  $dailyOfferId = $_GET['DailyId'];

  $dailyOffer = $session->getDailyOffer($dailyOfferId);
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    try {
      $name = $_POST['name']; //Emri i daily offer
      $pizza = $_POST['pizza']; //Pizza
      $size = $_POST['size'];//Madhesia e pizzes
      $drink = $_POST['drink'];//Pija
      $price = $_POST['price-dailyOffer']; //Qmimi i daily offer 

      $sql = "UPDATE dailyoffer SET DO_Name=:name,DO_Price=:price,PizzaFK=:pizza, SizeFK=:size, DrinksFK=:drink where DailyId=:id";
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam(':id', $dailyOfferId);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':price', $price);
      $stmt->bindParam(':pizza', $pizza);
      $stmt->bindParam(':size', $size);
      $stmt->bindParam(':drink', $drink);

      $stmt->execute();

    } catch (Exception $e) {
      return $e->getMessage();
    }

    echo '<p>Daily Offer successfully updated!</p>';

  }


  $dailyOffer = $session->getDailyOffer($dailyOfferId);

  ?>
  <h2>Edit <?= $dailyOffer['DO_Name'] ?></h2>


  <form class="admin-form" method="post" enctype="multipart/form-data">


    <fieldset>
      <legend>Details</legend>

      <ul>
        <li>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?= $dailyOffer['DO_Name'] ?>"/>
        </li>
        <li>

          <?php
          $pizzas = $session->getPizzas();
          echo '<label for="pizza">Pizza:</label>';
          echo '<select name="pizza" id="pizza">';
          foreach ($pizzas as $key => $value) {
            if ($value['p_id'] == $dailyOffer['PizzaFK']) {
              echo '<option value="' . $value['p_id'] . '" selected="selected">' . $value['p_name'] . '</option>';
            } else {
              echo '<option value="' . $value['p_id'] . '">' . $value['p_name'] . '</option>';
            }
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
            if ($value['id'] == $dailyOffer['SizeFK']) {
              echo '<option value="' . $value['id'] . '" selected="selected">' . $value['name'] . '</option>';
            } else {
              echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
            }
          }
          echo '</select>';
          ?>
        </li>
        <?php
        $drinks = $session->getDrinks();
        echo '<label for="drink">Drink:</label>';
        echo '<select name="drink" id="drink">';
        foreach ($drinks as $key => $value) {
          if ($value['D_id'] == $dailyOffer['DrinksFK']) {
            echo '<option value="' . $value['D_id'] . '" selected="selected">' . $value['D_Name'] . '</option>';
          } else {
            echo '<option value="' . $value['D_id'] . '">' . $value['D_Name'] . '</option>';
          }
        }
        echo '</select>';

        ?>
        <li>

        </li>
      </ul>
    </fieldset>


    <fieldset>
      <legend>Price</legend>
      <ul>
        <li>
          <?php
          $dailyOffer = $session->getDailyOffer($dailyOfferId);


          echo '<label for="price-dailyOffer">Daily Offer Price:</label>';
          echo '<input type="text" value="' . $dailyOffer['DO_Price'] . ' " id="price-dailyOffer" name="price-dailyOffer" />';

          ?>
        </li>
      </ul>
    </fieldset>


    <div class="buttons">
      <button type="submit" class="button icon go" title="Update" name="action" value="update">Update</button>
      <a class="button icon cancel" title="Cancel" href="list-dailyoffers.php">Cancel</a>
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

