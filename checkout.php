<?php
include('includes/session.php');
//session_start();
require_once 'includes/class.user.php';
$user_home = new USER();
ob_start();
/* 	if(!$user_home->is_logged_in())
	{
		$user_home->redirect('includes/login.php');
	}
 */
if ($user_home->is_logged_in()) {
  $stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
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
  <title>GrandmaPizzas | Checkout</title>

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


if ($user_home->is_logged_in())
{
$userId = $_SESSION['userSession'];
$user = $session->getUser($userId);
if ($user['userAdmin'] == 0)
{


?>
<!-- Pre Loader -->
<!-- <div id="aa-preloader-area">
  <div class="mu-preloader">
    <img src="assets/img/preloader.gif" alt=" loader img">
  </div>
</div> -->
<!--START SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#">
  <i class="fa fa-angle-up"></i>
  <span>Top</span>
</a>
<!-- END SCROLL TOP BUTTON -->

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
          if (!$user_home->is_logged_in()){
            echo '<li><a href="includes/login.php">LOG IN / SIGN UP</a></li>';
          }else { ?>
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


          <!-- <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="blog-archive.html">PAGE <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="blog-archive.html">BLOG</a></li>
              <li><a href="blog-single.html">BLOG DETAILS</a></li>
              <li><a href="404.html">404 PAGE</a></li>
            </ul>
          </li> -->
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
</header>
<!-- End header section -->


<!-- Start basket section -->


<div class="container my-checkout">
  <form action="payment.php" method="POST" enctype="multipart/form-data">
    <?php
    $userId = $row['userID'];
    $order = $session->getOrderId($userId);
    $orderId = $order['Order_Id'];
    $totalCosts = 0;
    // var_dump($orderId);

    ?>
    <div class="row">


      <div class="col-md-8">
        <div class="addresses">
          <?php
          $addresses = $session->getUserAddresses($userId);

          foreach ($addresses as $key => $value) {


            ?>
            <div class="radio">
              <label>
                <input type="radio" required name="delivery-addresses" value="<?= $value['address_id'] ?>">
                Address line 1: <?= $value['address_1'] ?>,<br/>
                Address line 2: <?= $value['address_2'] ?>,<br/>
                City:<?= $value['city'] ?>,
                Postal code: <?= $value['postal_code'] ?>
              </label>
            </div>

            <?php

          }

          ?>

          <div class="radio">
            <label>
              <input type="radio" required name="delivery-addresses" value="new-address">
              Enter a new address below:
            </label>
          </div>

        </div>


        <h3>New address:</h3>

        <div class="form-group">
          <label for="address-1">Address line 1:</label>
          <input type="text" class="form-control" id="address-1" name="Address_1">
        </div>
        <div class="form-group">
          <label for="address-2">Address line 2:</label>
          <input type="text" class="form-control" id="address-2" name="Address_2">
        </div>
        <div class="form-group">
          <label for="city">City:</label>
          <input type="text" class="form-control" id="city" name="City">
        </div>
        <div class="form-group">
          <label for="postal-code">Postal code:</label>
          <input type="text" class="form-control" id="postal-code" name="Postal_Code">
        </div>

      </div>

      <div class="col-md-4">
        <div class="order-summary">
          <h2>Your order</h2>
          <ul class="items-list">
            <?php
            $suborders = $session->getOrderProducts($orderId);
            foreach ($suborders as $key => $value) {
              $subOrderId = $value['OrderProductsId'];//Mos e ndrysho
              // var_dump($value);
              //   var_dump($subOrderId);

              $pizzaProduct = $session->getPizzaProduct($subOrderId);
              if ($value['Pizza_IdFK'] == null) {
                $dailyOfferProduct = $session->getDailyOffer($value['DailyIdFK']);

                $totalCosts += $dailyOfferProduct['DO_Price'] * $value['Quantity'];
                $itemPrice = $dailyOfferProduct['DO_Price'] * $value['Quantity'];

                ?>

                <li>
                  <span class="item-name"><?= $dailyOfferProduct['DO_Name']; ?></span>
                  <span class="qty"><?= $value['Quantity'] ?></span>
                  <span class="cost">$<?php echo $itemPrice; ?></span>
                </li>

                <?php
              } else {
                $pizzaProduct = $session->getPizza($value['Pizza_IdFK']);
                $pizzaPrices = $session->getProductPrice($value['Pizza_IdFK'], $value['Size']);
                $totalCosts += $value['Quantity'] * $pizzaPrices['price'];
                $itemPrice = $value['Quantity'] * $pizzaPrices['price'];
                ?>
                <li>
                  <span class="item-name"><?= $pizzaProduct['p_name']; ?></span>
                  <span class="qty"><?= $value['Quantity'] ?></span>
                  <span class="cost">$<?php echo $itemPrice; ?></span>
                </li>


                <?php

              }
            }

            }
            ?>
          </ul>
          <ul class="cost-list">

            <li class="total">
              <span class="cost-item">Total</span>
              <span class="cost">$<?php echo $totalCosts; ?></span>
              <input type="hidden" name="TotalCost" value="<?php echo $totalCosts; ?>" readonly>
            </li>
          </ul>


          <button type="submit" id="placeOrder" class="mu-send-btn">Place order</button>
        </div>
      </div>
    </div>

  </form>

  <?php }
  else {
    $user_home->redirect('index.php');
  }
  }
  else {
    //ob_end();
    $user_home->redirect('index.php');


    //header("Location: ../../index.php" );
    //exit();


  }
  ?>


</div>

<!-- End basket section -->


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