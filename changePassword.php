<?php
include('includes/session.php');
//session_start();
require_once 'includes/class.user.php';
$user_login = new USER();
ob_start();
/*  if(!$user_login->is_logged_in())
    {
        $user_login->redirect('includes/login.php');
    }
 */
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

  <script>
    var currencies = {
      euro: {
        sign: '<i class="fa fa-euro"></i>',
        rate: 0.94
      },
      gbp: {
        sign: '<i class="fa fa-gbp"></i>',
        rate: 0.81
      },
      dollar: {
        sign: '<i class="fa fa-dollar"></i>',
        rate: 1
      }
    }

    function updatePrice(currency) {
      $('.currency')
        .each(function () {
          var $e = $(this);
          var newPrice = currencies[currency].rate * $e.data('pizza-price');

          newPrice = Math.round(newPrice * 100) / 100;

          $e.html(currencies[currency].sign + newPrice);
        });
    }
  </script>

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
  <nav class="navbar navbar-default mu-main-navbar navbar-bg" role="navigation" style="
    background-color: rgba(0, 0, 0, 0.8);
">
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
        <!--  Text based logo  -->
        <!--           <a class="navbar-brand" href="index.html"><span>SpicyX</span></a>   -->
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul id="top-menu" class="nav navbar-nav navbar-right mu-main-nav">
          <li><a href="index.php">HOME</a></li>
          <li><a href="index.php">ABOUT US</a></li>
          <li><a href="index.php">MENU</a></li>
          <!-- <li><a href="#mu-reservation">RESERVATION</a></li>   -->
          <li><a href="index.php">GALLERY</a></li>
          <!-- <li><a href="#mu-chef">OUR TEAM</a></li> -->
          <!-- <li><a href="#mu-latest-news">BLOG</a></li>  -->
          <li><a href="index.php">CONTACT</a></li>
          <?php
          if (!$user_login->is_logged_in()) {
            echo '<li><a href="includes/login.php">LOG IN / SIGN UP</a></li>';
          } else { ?>
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

    $oldPassword = $_POST['oldpass'];
    $newPassword = $_POST['newpass'];
    $confirmNewPassword = $_POST['newpassconfirm'];

    //var_dump($user);


    //echo $newPassword;
    //echo $confirmNewPassword;
    if (password_verify($oldPassword, $user['userPassword'])) {
      if ($newPassword === $confirmNewPassword && !empty($newPassword) && !empty($confirmNewPassword)) {

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET userPassword = :userPassword WHERE userID = :userID";
        $stmt = $database->connection->prepare($sql);
        $stmt->bindparam(":userPassword", $newPassword);
        $stmt->bindparam(":userID", $userId);
        $stmt->execute();
        $msg = "Your Password has been succesfully changed.";
      } else {
        $msg = "Your new password is incorrect, please try again.";
      }
    } else {
      if (empty($oldPassword) && empty($newPassword) && empty($confirmNewPassword)) {

        $msg = "You didn't fill out any of the fields.";
      } elseif (empty($oldPassword)) {
        $msg = "You didn't type your current password.";
      } else {
        $msg = "Your current password has been typed incorrectly. Try again.";
      }

    }


    //echo '<p>Your account details have been successfully updated!</p>';
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-push-2 col-sm-10 col-sm-push-1">
          <div class="alert alert-success">
            <?php echo $msg; ?>
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


        <form class="admin-form" method="post">


          <fieldset>
            <legend>Change Password</legend>

            <div class="form-group">
              <label for="name">Current Password:</label>
              <input id="pass" type="password" class="form-control" data-type="password" name="oldpass">
            </div>

            <div class="form-group">
              <label for="surname">New Password:</label>
              <input id="pass" type="password" class="form-control" data-type="password" name="newpass">
            </div>

            <div class="form-group">
              <label for="email">Repeat New Password:</label>
              <input id="pass" type="password" class="form-control" data-type="password" name="newpassconfirm">
            </div>
          </fieldset>


          <div class="buttons">
            <button type="submit" class="mu-btn icon go" title="Update" name="action" value="update">Update</button>
            <a class="mu-btn icon cancel" title="Cancel" href="list-users.php">Cancel</a>
          </div>

        </form>

      </div>

    </div>

  </div>

  <?php }
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