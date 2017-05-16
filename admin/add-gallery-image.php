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
  <title>Add gallery image - GrandmasPizza Admin</title>

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
      <!--  <li><a href="index.php?action=manageotherfood">Other Food</a></li>
       <li><a href="index.php?action=managedrinks">Drinks</a></li> -->
      <li class="active"><a href="list-gallery-images.php">Image Library</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">

  <h2>Add Gallery image</h2>

  <form class="admin-form" method="post" action="../includes/process.php" enctype="multipart/form-data">
    <input type="hidden" name="action" value="doaddimage"/>
    <!-- you might not want this - I used it to specify what the next action would be after submitting the form -->


    <ul>
      <li>
        <label for="title">Gallery item title:</label>
        <input type="text" id="title" name="title"/>
      </li>
      <li>
        <label for="description">Description:<br/></label>
        <textarea id="description" name="description" rows="4"></textarea>
      </li>
      <li>
        <label for="new-image">Photo:</label>
        <input type="file" id="new-image" name="new-image"/>
      </li>
    </ul>


    <div class="buttons">
      <button type="submit" class="button icon go" title="Submit" value="addGallery" name="action">Submit</button>
      <a class="button icon cancel" title="Cancel" href="list-gallery-images.php">Cancel</a>
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

