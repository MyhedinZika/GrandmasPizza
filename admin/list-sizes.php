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
  <title>Pizza Sizes List - GrandmasPizza Admin</title>

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
          <li class="active"><a href="list-sizes.php">Sizes</a></li>
        </ul>
      </li>
      <!--    <li><a href="index.php?action=manageotherfood">Other Food</a></li>
         <li><a href="index.php?action=managedrinks">Drinks</a></li> -->
      <li><a href="list-gallery-images.php">Image Library</a></li>
      <li><a href="list-dailyoffers.php">Daily Offers</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">

  <?php

  if (isset($_POST['action']) && $_POST['action'] === 'addSize') {

    $name = $_POST['size-name'];
    $diameter = $_POST['size-diameter'];

    $result = $session->addSize($name, $diameter);

    echo $result;
  }

  if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $size = $session->getSize($_GET['id']);

    if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
      $result = $session->deleteSize($_GET['id']);

      echo $result; // TODO styling for error/success
    } else {
      // ask for confirmation
      ?>
      <p>Are you sure you want to delete <?= $size['name'] ?>, <?= $size['diameter'] ?>cm?</p>
      <p>
        <a href="list-sizes.php?action=delete&id=<?= $size['id'] ?>&confirmed=true">Yes</a> -
        <a href="list-sizes.php">No</a>
      </p>
      <?php
    }
  }

  ?>


  <h2>Pizza Sizes</h2>

  <ul class="items-list clearfix">
    <?php
    $sizes = $session->getSizes();

    foreach ($sizes as $size):
      ?>
      <li>
        <h3><?= $size['name'] ?>, <?= $size['diameter'] ?>cm</h3>

        <div class="actions">
          <a class="button icon delete" href="list-sizes.php?action=delete&id=<?= $size['id'] ?>">Delete</a>
          <a class="button icon edit" href="edit-size.php?id=<?= $size['id'] ?>">Edit</a>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

  <form class="admin-form" method="POST">
    Name: <input type="text" id="size-name" name="size-name" style="min-width: 200px"/> Diameter: <input type="text"
                                                                                                         id="size-diameter"
                                                                                                         name="size-diameter"
                                                                                                         style="min-width: 200px"/>
    <button type="submit" class="button inline add" title="Add size" value="addSize" name="action">Add new Pizza size
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

