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
  <title>Pizza Category List - GrandmasPizza Admin</title>

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
          <li class="active"><a href="list-categories.php">Categories</a></li>
          <li><a href="list-ingredients.php">Ingredients</a></li>
          <li><a href="list-sizes.php">Sizes</a></li>
        </ul>
      </li>
      <!--  <li><a href="index.php?action=manageotherfood">Other Food</a></li>
       <li><a href="index.php?action=managedrinks">Drinks</a></li> -->
      <li><a href="list-gallery-images.php">Image Library</a></li>
      <li><a href="list-dailyoffers.php">Daily Offers</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">


  <h2>Pizza Categories</h2>

  <?php

  if (isset($_POST['action']) && $_POST['action'] === 'addCategory') {

    $categoryName = $_POST['category-name'];

    $result = $session->addCategory($categoryName);

    echo $result;
  }

  if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['c_id'])) {
    $category = $session->getOneCategory($_GET['c_id']);

    if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
      $result = $session->deleteCategory($_GET['c_id']);

      echo $result; // TODO styling for error/success
    } else {
      // ask for confirmation
      ?>
      <p>Are you sure you want to delete <?= $category['c_name'] ?>?</p>
      <p>
        <a href="list-categories.php?action=delete&c_id=<?= $category['c_id'] ?>&confirmed=true">Yes</a> -
        <a href="list-categories.php">No</a>
      </p>
      <?php
    }
  }

  ?>

  <ul class="items-list clearfix">
    <?php
    $categories = $session->getCategory();

    foreach ($categories as $cat):
      ?>
      <li>
        <h3><?= $cat['c_name'] ?></h3>

        <div class="actions">
          <a class="button icon delete" href="list-categories.php?action=delete&c_id=<?= $cat['c_id'] ?>">Delete</a>
          <a class="button icon edit" href="edit-category.php?c_id=<?= $cat['c_id'] ?>">Edit</a>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

  <form class="admin-form" method="post">
    <input type="text" id="category-name" name="category-name"/>
    <button type="submit" class="button inline add" title="Add category" value="addCategory" name="action">Add new Pizza
      category
    </button>
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

