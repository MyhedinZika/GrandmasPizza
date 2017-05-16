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
  <title>Gallery image list - GrandmasPizza Admin</title>

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
      <li class="active"><a href="list-gallery-images.php">Image Library</a></li>
      <li><a href="list-dailyoffers.php">Daily Offers</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">


  <h2>Gallery images</h2>
  <?php

  if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['g_id'])) {
    $gallery = $session->getGallery($_GET['g_id']);

    if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
      $result = $session->deleteGallery($_GET['g_id']);

      echo $result; // TODO styling for error/success
    } else {
      // ask for confirmation
      ?>
      <p>Are you sure you want to delete <?= $gallery['g_title'] ?>?</p>
      <p>
        <a href="list-gallery-images.php?action=delete&g_id=<?= $gallery['g_id'] ?>&confirmed=true">Yes</a> -
        <a href="list-gallery-images.php">No</a>
      </p>
      <?php
    }
  }

  ?>


  <ul class="items-list gallery clearfix">
    <?php
    $galleries = $session->getGalleries();

    foreach ($galleries as $gallery):
      ?>
      <li>
        <img src="../includes/gallery_images/<?= $gallery['g_photo'] ?> "
             style=" max-width: 200px; min-width: 200px; float: left;" alt="<?= $gallery['g_title'] ?>">


        <div class="actions">
          <a class="button icon delete"
             href="list-gallery-images.php?action=delete&g_id=<?= $gallery['g_id'] ?>">Delete</a>
          <a class="button icon edit" href="edit-gallery-image.php?g_id=<?= $gallery['g_id'] ?>">Edit</a>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>


  <p>
    <a class="button add" href="add-gallery-image.php">Add New Image</a>
  </p>
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

