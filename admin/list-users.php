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
  <title>User List - GrandmasPizza Admin</title>

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
      <!-- <li><a href="index.php?action=manageotherfood">Other Food</a></li>
      <li><a href="index.php?action=managedrinks">Drinks</a></li> -->
      <li><a href="list-gallery-images.php">Image Library</a></li>
      <li><a href="list-dailyoffers.php">Daily Offers</a></li>
      <li class="active"><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>

    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">


  <h2>Users</h2>

  <?php

  if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['userID'])) {
    $user = $session->getUser($_GET['userID']);

    if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
      $result = $session->deleteUser($_GET['userID']);

      echo $result; // TODO styling for error/success
    } else {
      // ask for confirmation
      ?>
      <p>Are you sure you want to delete <?= $user['userName'] ?>?</p>
      <p>
        <a href="list-users.php?action=delete&userID=<?= $user['userID'] ?>&confirmed=true">Yes</a> -
        <a href="list-users.php">No</a>
      </p>
      <?php
    }
  }

  ?>

  <ul class="items-list clearfix">
    <?php
    $users = $session->getUsers();

    foreach ($users as $user):
      ?>
      <li>
        <h3><?= $user['userName'] ?><?php echo '&nbsp'; ?><?= $user['userSurname'] ?></h3>

        <div class="actions">
          <a class="button icon delete" href="list-users.php?action=delete&userID=<?= $user['userID'] ?>">Delete</a>
          <a class="button icon edit" href="edit-user.php?userID=<?= $user['userID'] ?>">Edit</a>

        </div>
      </li>

    <?php endforeach; ?>
  </ul>

  <?php }
  elseif ($user['userAdmin'] == 3){ ?>
  <div id="header" class="page-header">
    <a href="frontPage.php" class="logo-home">
      <img id="logo" src="../ui/images/logo.png" alt="Grandmas Pizza"/>
    </a>

    <h1>GrandmasPizza Owner Administration</h1>

    <div class="navbar">
      <ul class="nav">
        <li class="right"><a href="../" target="_blank">View Live Site</a></li>
        <li><a href="owner.php">Reports</a>
          <!--<ul class="subnav">
              <li><a href="list-categories.php">Daily</a></li>
              <li><a href="list-ingredients.php">Monthly</a></li>
              <li><a href="list-sizes.php">Yearly</a></li>
          </ul>-->
        </li>
        <!--  <li><a href="index.php?action=manageotherfood">Other Food</a></li>
         <li><a href="index.php?action=managedrinks">Drinks</a></li> -->
        <!--<li><a href="list-gallery-images.php">Image Library</a></li>
        <li><a href="list-dailyoffers.php">Daily Offers</a></li>-->
        <li class="active"><a href="list-users.php">Users</a></li>
        <li class="right"><a href="../includes/logout.php">Log Out</a></li>
      </ul>
    </div>

  </div><!-- /.page-header -->

  <div class="page-body">


    <h2>Users</h2>

    <?php

    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['userID'])) {
      $user = $session->getUser($_GET['userID']);

      if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
        $result = $session->deleteUser($_GET['userID']);

        echo $result; // TODO styling for error/success
      } else {
        // ask for confirmation
        ?>
        <p>Are you sure you want to delete <?= $user['userName'] ?>?</p>
        <p>
          <a href="list-users.php?action=delete&userID=<?= $user['userID'] ?>&confirmed=true">Yes</a> -
          <a href="list-users.php">No</a>
        </p>
        <?php
      }
    }

    ?>

    <ul class="items-list clearfix">
      <?php
      $users = $session->getUsers();

      foreach ($users as $user):
        ?>
        <li>
          <h3><?= $user['userName'] ?><?php echo '&nbsp'; ?><?= $user['userSurname'] ?></h3>

          <div class="actions">
            <a class="button icon delete" href="list-users.php?action=delete&userID=<?= $user['userID'] ?>">Delete</a>
            <a class="button icon edit" href="edit-user.php?userID=<?= $user['userID'] ?>">Edit</a>

          </div>
        </li>

      <?php endforeach; ?>
    </ul>
    <?php

    }
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

