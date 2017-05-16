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
  <title>Edit pizza - GrandmasPizza Admin</title>

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

      <li class="active"><a href="list-pizzas.php">Pizzas</a>
        <ul class="subnav">
          <li><a href="list-categories.php">Categories</a></li>
          <li><a href="list-ingredients.php">Ingredients</a></li>
          <li><a href="list-sizes.php">Sizes</a></li>
        </ul>
      </li>

      <li><a href="imagelibrary.php?type=relprod">Image Library</a></li>
      <li><a href="list-dailyoffers.php">Daily Offers</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">
  <?php

  $pizzaId = $_GET['p_id'];

  $pizza = $session->getPizza($pizzaId);
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    try {
      $name = $_POST['name'];// name of pizza

      $imgFile = $_FILES['new-image']['name'];
      $tmp_dir = $_FILES['new-image']['tmp_name'];
      $imgSize = $_FILES['new-image']['size'];

      $category = $_POST['category'];
      $ingredients = $_POST['ingredients'];

      $prices = $_POST['price'];

      if (empty($name)) {
        $errMSG = "Please enter pizza name.";
      }

      if (!empty($imgFile)) {
        $upload_dir = __DIR__ . '/../includes/pizza_images/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

        // rename uploading image
        $userpic = rand(1000, 1000000) . "." . $imgExt;

        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
          // Check file size '5MB'
          if ($imgSize < 5000000) {
            unlink($upload_dir . $pizza['p_photo']);
            move_uploaded_file($tmp_dir, $upload_dir . $userpic);
          } else {
            $errMSG = "Sorry, your file is too large.";
          }
        } else {
          $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
      } else { // photo not updated
        $userpic = $pizza['p_photo'];
      }


      //update Pizza
      if (!isset($errMSG)) {

        $sql = "UPDATE pizza SET p_name=:name,p_photo=:photo,Category=:category where p_id=:id";
        $stmt = $database->connection->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':photo', $userpic);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':id', $pizzaId);
        $stmt->execute();
      }

      if (!isset($errMSG)) {
        $stmt = $database->connection->prepare('DELETE FROM pizza_ingredient WHERE pizza = :pizza');
        $stmt->bindParam(':pizza', $pizzaId);

        if (!$stmt->execute()) {
          $errMSG = "error while deleting all pizza ingredients from pizza_ingredients";
        }

        foreach ($ingredients as $ingredient) {
          $stmt = $database->connection->prepare('INSERT INTO pizza_ingredient(pizza,ingredient) VALUES(:pizza,:ingredient)');
          $stmt->bindParam(':ingredient', $ingredient);
          $stmt->bindParam(':pizza', $pizzaId);

          if (!$stmt->execute()) {
            $errMSG = "error while inserting into pizza_ingredients";
          }
        }
      }


      //insert prices good :P so same with prices now, yup
      if (!isset($errMSG)) {
        $stmt = $database->connection->prepare('DELETE FROM pizza_size WHERE pizza = :pizza');
        $stmt->bindParam(':pizza', $pizzaId);

        if (!$stmt->execute()) {
          $errMSG = "error while deleting all pizza sizes from pizza_size";
        }


        foreach ($prices as $sizeId => $price) {
          $stmt = $database->connection->prepare('INSERT INTO pizza_size(pizza,size,price) VALUES(:pizza, :size, :price)');
          $stmt->bindParam(':pizza', $pizzaId);
          $stmt->bindParam(':size', $sizeId);
          $stmt->bindParam(':price', $price);

          if (!$stmt->execute()) {
            $errMSG = "error while inserting into pizza_size";
          }
        }
      }


    } catch (Exception $e) {
      return $e->getMessage();
    }

    echo '<p>Pizza successfully updated!</p>';

  }


  $name = $pizza['p_name'];
  $pizza = $session->getPizza($pizzaId);

  ?>
  <h2>Edit <?= $pizza['p_name'] ?></h2>


  <form class="admin-form" method="post" enctype="multipart/form-data">


    <fieldset>
      <legend>Details</legend>

      <ul>
        <li>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?= $pizza['p_name'] ?>"/>
        </li>
        <li>
          <label for="image">Photo:</label>
          <img class="product-photo" src="../includes/pizza_images/<?= $pizza['p_photo'] ?>"/>
        </li>
        <li>
          <label for="image">Update photo:</label>
          <input type="file" id="new-image" name="new-image"/>
        </li>
        <li>

          <?php
          $categories = $session->getCategory();
          echo '<label for="category">Category:</label>';
          echo '<select name="category" id="category">';
          foreach ($categories as $key => $value) {
            if ($value['c_id'] == $pizza['Category']) {
              echo '<option value="' . $value['c_id'] . '" selected="selected">' . $value['c_name'] . '</option>';
            } else {
              echo '<option value="' . $value['c_id'] . '">' . $value['c_name'] . '</option>';
            }
          }
          echo '</select>';
          ?>
        </li>
        <li>
          <label for="ingredients">Ingredients</label>


          <?php
          $ingredientsPizza = $session->getPizzaIngredients($pizzaId);

          function pizzaIngredientCheck($pizzaIngredients, $ingredientId)
          {
            foreach ($pizzaIngredients as $pizzaIngredient) {

              //var_dump($pizzaIngredient);
              if ($pizzaIngredient['i_id'] == $ingredientId) {
                return true;
              }
            }

            return false;
          }


          // var_dump($ingredientsPizza);


          $ingredients = $session->getIngredients();

          echo '<select name="ingredients[]" id="ingredients" multiple>';
          foreach ($ingredients as $key => $value) {
            if (pizzaIngredientCheck($ingredientsPizza, $value['i_id']) === true) {
              echo '<option value="' . $value['i_id'] . '" selected="selected">' . $value['i_name'] . ' </option>';
            } else {
              echo '<option value="' . $value['i_id'] . '">' . $value['i_name'] . '</option>';
            }
          }
          echo '</select>';

          ?>


          <span class="form-help">Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</span>
        </li>
      </ul>
    </fieldset>


    <fieldset>
      <legend>Prices</legend>
      <ul>
        <?php
        $sizes = $session->getPizzaPrices($pizzaId);

        // var_dump($sizes);

        $pizzaIdSize = 1;
        foreach ($sizes as $key => $value) {
          echo '<li>';
          echo '<label for="price-' . $value['id'] . '">' . $value['name'] . ':</label>';
          echo '<input type="text" id="price-' . $value['id'] . '" name="price[' . $value['id'] . ']" value=' . $value['price'] . ' />';
          echo '</li>';
        }
        ?>
      </ul>
    </fieldset>


    <div class="buttons">
      <button type="submit" class="button icon go" title="Update" name="action" value="update">Update</button>
      <a class="button icon cancel" title="Cancel" href="list-pizzas.php">Cancel</a>
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

<!--     <?php
// function pizzaIngredientCheck(){

//   foreach($pizzaIngredients as $ingr) {
//     echo $ingr;}
// }

?> -->
</body>
</html>

