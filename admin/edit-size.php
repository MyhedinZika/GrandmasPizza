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
  <title>Edit Pizza size - GrandmasPizza Admin</title>

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
      <!-- <li><a href="index.php?action=manageotherfood">Other Food</a></li>
      <li><a href="index.php?action=managedrinks">Drinks</a></li>-->
      <li><a href="imagelibrary.php?type=relprod">Image Library</a></li>
      <li><a href="list-dailyoffers.php">Daily Offers</a></li>
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">
  <?php
  if (isset($_GET['id'])) {
    if (isset($_POST['action']) && $_POST['action'] === 'update' && isset($_POST['size-name']) && isset($_POST['size-diameter'])) {
      $result = $session->updateSize($_GET['id'], $_POST['size-name'], $_POST['size-diameter']);
      echo "<p>$result</p>";
    }
  }


  $size = $session->getSize($_GET['id']);
  ?>


  <h2>Edit size <?= $size['name'] ?></h2>

  <form class="admin-form" method="post">


    <ul>
      <li>
        Name: <input type="text" id="size-name" name="size-name" style="min-width: 200px" value="<?= $size['name'] ?>"/>
        Diameter: <input type="text" id="size-diameter" name="size-diameter" style="min-width: 200px"
                         value="<?= $size['diameter'] ?>"/>
      </li>
    </ul>


    <div class="buttons">
      <button type="submit" class="button icon go" title="Update" name="action" value="update">Update</button>
      <a class="button icon cancel" title="Cancel" href="list-sizes.php">Cancel</a>
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

