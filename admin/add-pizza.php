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
  <title>Add pizza - GrandmasPizza Admin</title>

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

      <li class="active"><a href="list-pizzas.php">Pizzas</a></li>
      <!-- <li><a href="index.php?action=manageotherfood">Other Food</a></li>
      <li><a href="index.php?action=managedrinks">Drinks</a></li>
      <li><a href="imagelibrary.php?type=relprod">Image Library</a></li> -->
      <li><a href="list-gallery-images.php">Image Library</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">

  <h2>Add Pizza</h2>

  <form class="admin-form" method="post" action="../includes/process.php" enctype="multipart/form-data">
    <fieldset>
      <legend>Details</legend>

      <ul>
        <li>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name"/>
        </li>
        <li>
          <label for="new-image">Photo:</label>
          <input type="file" id="new-image" name="new-image"/>
        </li>
        <li>
          <?php
          $categories = $session->getCategory();
          echo '<label for="category">Category:</label>';
          echo '<select name="category" id="category">';
          foreach ($categories as $key => $value) {
            echo '<option value="' . $value['c_id'] . '">' . $value['c_name'] . '</option>';
          }
          echo '</select>';
          ?>
        </li>
        <li>
          <label for="ingredients">Ingredients</label>
          <?php
          $ingredients = $session->getIngredients();

          echo '<select name="ingredients[]" id="ingredients" multiple>';
          foreach ($ingredients as $key => $value) {
            echo '<option value="' . $value['i_id'] . '">' . $value['i_name'] . '</option>';
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
        $sizes = $session->getSizes();

        foreach ($sizes as $key => $value) {
          echo '<li>';
          echo '<label for="price-' . $value['id'] . '">' . $value['name'] . ':</label>';
          echo '<input type="text" id="price-' . $value['id'] . '" name="price[' . $value['id'] . ']" />';
          echo '</li>';
        }
        ?>
      </ul>
    </fieldset>


    <div class="buttons">
      <button type="submit" class="button icon go" title="Submit" value="addPizza" name="action">Submit</button>
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

