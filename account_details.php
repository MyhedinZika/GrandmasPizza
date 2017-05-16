<?php
include('includes/session.php');
require_once 'includes/class.user.php';
$user_login = new USER();
ob_start();
if ($user_login->is_logged_in()) {
  $stmt = $user_login->runQuery("SELECT * FROM users WHERE userID=:uid");
  $stmt->execute(array(":uid" => $_SESSION['userSession']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GrandmaPizzas | Account details</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/d/d8/Pizza_slice_icon.png"
        type="image/x-icon">
  <!-- Font awesome -->
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!-- Slick slider -->
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
  <!-- Date Picker -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
  <!-- Theme color -->
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Main style sheet -->
  <link href="style.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
<?php
if ($user_login->is_logged_in())
{
$userId = $_SESSION['userSession'];
$user = $session->getUser($userId);
if ($user['userAdmin'] == 0)
{
?>
<!-- Start header section -->
<header id="mu-header">
  <nav class="navbar navbar-default mu-main-navbar navbar-bg" role="navigation"
       style="background-color: rgba(0, 0, 0, 0.8);">
    <div class="container">
      <div class="navbar-header">
        <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- LOGO -->
        <!--  Image based logo  -->
        <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt="Logo img"></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul id="top-menu" class="nav navbar-nav navbar-right mu-main-nav">
          <li><a href="index.php">HOME</a></li>
          <li><a href="index.php">ABOUT US</a></li>
          <li><a href="index.php">MENU</a></li>
          <li><a href="index.php">GALLERY</a></li>
          <li><a href="index.php">CONTACT</a></li>
          <?php
          if (!$user_login->is_logged_in()) {
            echo '<li><a href="includes/login.php">LOG IN / SIGN UP</a></li>';
          } else {
            ?>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                    href="index.php"><?php echo strtoupper($row['userName']); ?>
                <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="account_details.php">ACCOUNT DETAILS</a></li>
                <li><a href="cart.php">MY CART</a></li>
                <li><a href="changePassword.php">CHANGE PASSWORD</a></li>
                <li><a href="../includes/logout.php">LOG OUT</a></li>
              </ul>
            </li>
            <?php
          }
          ?>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
</header>
<!-- End header section -->

<div class="page-body" style="margin-top: 150px; margin-bottom: 100px;">
  <?php

  $userId = $user['userID'];
  $user = $session->getUser($userId);

  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    try {
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $gender = $_POST['gender'];
      $phone = $_POST['phone'];

      $sql = "UPDATE users SET userName = :user_name,userSurname = :user_surname,
                          userGender = :user_gender,userPhone = :user_phone WHERE userID = :userID";
      $stmt = $database->connection->prepare($sql);
      $stmt->bindparam(":user_name", $name);
      $stmt->bindparam(":user_surname", $surname);
      $stmt->bindparam(":user_gender", $gender);
      $stmt->bindparam(":user_phone", $phone);
      $stmt->bindparam(":userID", $userId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-push-2 col-sm-10 col-sm-push-1">
          <div class="alert alert-success">
            Your account details have been successfully updated!
          </div>
        </div>
      </div>
    </div>
    <?php
  }
  $user = $session->getUser($userId);
  ?>


  <div class="container">

    <div class="row">
      <div class="col-md-6 col-md-push-3 col-sm-8 col-sm-push-2">
        <h2>Edit <?= $user['userName'] ?><?php echo '&nbsp'; ?><?= $user['userSurname'] ?></h2>
        <form class="admin-form" method="post">
          <fieldset>
            <legend>Details</legend>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" class="form-control" name="name" value="<?= $user['userName'] ?>"/>
            </div>
            <div class="form-group">
              <label for="surname">Surname:</label>
              <input type="text" id="surname" class="form-control" name="surname" value="<?= $user['userSurname'] ?>"/>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" id="email" class="form-control" name="email" disabled
                     value="<?= $user['userEmail'] ?>"/>
            </div>
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select name="gender" id="gender" class="form-control">
                <?php
                if ($user['userGender'] === 'M') {
                  echo '<option value="M" selected="selected">Male</option>';
                  echo '<option value="F">Female</option>';
                } else {
                  echo '<option value="M" >Male</option>';
                  echo '<option value="F" selected="selected">Female</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="text" id="phone" class="form-control" name="phone" value="<?= $user['userPhone'] ?>"/>
            </div>
          </fieldset>

          <div class="buttons">
            <button type="submit" class="mu-btn icon go" title="Update" name="action" value="update">Update</button>
            <a class="mu-btn icon cancel" title="Cancel" href="account_details.php">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  }
  else {
    $user_login->redirect('index.php');
  }
  }
  else {
    //ob_end();
    $user_login->redirect('index.php');


    //header("Location: ../../index.php" );
    //exit();


  }
  ?>
</div><!-- /.page-body -->


<!-- Start Footer -->
<footer id="mu-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-footer-area">
          <div class="mu-footer-social">
            <a href="#"><span class="fa fa-facebook"></span></a>
            <a href="#"><span class="fa fa-twitter"></span></a>
            <a href="#"><span class="fa fa-google-plus"></span></a>
            <a href="#"><span class="fa fa-linkedin"></span></a>
            <a href="#"><span class="fa fa-youtube"></span></a>
          </div>
          <div class="mu-footer-copyright">
            <p>Copyrights &copy; <a rel="nofollow" href="#">2016</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer -->

<!-- jQuery library -->
<script src="assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.js"></script>
<!-- Slick slider -->
<script type="text/javascript" src="assets/js/slick.js"></script>
<!-- Counter -->
<script type="text/javascript" src="assets/js/waypoints.js"></script>
<script type="text/javascript" src="assets/js/jquery.counterup.js"></script>
<!-- Date Picker -->
<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>

<!-- Custom js -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/jquery.input-stepper.js"></script>

<script>
  $(function () {
    // Document ready
    $('.input-stepper').inputStepper();
  });
</script>

</body>
</html>