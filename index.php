<?php
include('includes/session.php');
//session_start();
require_once 'includes/class.user.php';
$user_home = new USER();

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
  <title>GrandmaPizzas | Home</title>

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

  <script type="text/javascript">
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

    function addToCart(event, Size, Quantity, Pizza_IdFK, DailyIdFK) {

      event.preventDefault();

      var cartItemData = {
        Size: Size,
        Quantity: Quantity,
        Pizza_IdFK: Pizza_IdFK,
        DailyIdFK: DailyIdFK
      };
      $.ajax({
        type: 'POST',
        url: 'addToCart.php',
        data: cartItemData
      }).then(function (data) {
        alert('Item successfully added to cart.');
      }, function (err, x, y) {
        console.log(err, x, y);
        alert('Item couldn\'t be added to cart.');
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
  <nav class="navbar navbar-default mu-main-navbar" role="navigation">
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
          <li><a href="#mu-slider">HOME</a></li>
          <li><a href="#mu-about-us">ABOUT US</a></li>
          <li><a href="#mu-restaurant-menu">MENU</a></li>
          <!-- <li><a href="#mu-reservation">RESERVATION</a></li>   -->
          <li><a href="#mu-gallery">GALLERY</a></li>
          <!-- <li><a href="#mu-chef">OUR TEAM</a></li> -->
          <!-- <li><a href="#mu-latest-news">BLOG</a></li>  -->
          <li><a href="#mu-contact">CONTACT</a></li>
          <?php
          if (!$user_home->is_logged_in()) {
            echo '<li><a href="../includes/login.php">LOG IN / SIGN UP</a></li>';
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


<!-- Start slider  -->
<section id="mu-slider">
  <div class="mu-slider-area">
    <!-- Top slider -->
    <div class="mu-top-slider">
      <!-- Top slider single slide -->
      <div class="mu-top-slider-single">
        <img src="assets/img/slider/banner1.png" alt="img">
        <!-- Top slider content -->
        <div class="mu-top-slider-content">
          <span class="mu-slider-small-title">Welcome to</span>
          <h2 class="mu-slider-title">Grandma's Pizzas</h2>
          <p>Square box,round pizza,triangle slices.</p>
          <a href="#mu-restaurant-menu" class="mu-readmore-btn">ORDER ONLINE</a>
        </div>
        <!-- / Top slider content -->
      </div>
      <!-- / Top slider single slide -->
      <!-- Top slider single slide -->
      <div class="mu-top-slider-single">
        <img src="assets/img/slider/banner_2.png" alt="img">
        <!-- Top slider content -->
        <div class="mu-top-slider-content">
          <span class="mu-slider-small-title">The Real Pizza</span>
          <h2 class="mu-slider-title">Never ordered online?</h2>
          <p>Dont worry,pizza is coming.</p>
          <a href="#mu-restaurant-menu" class="mu-readmore-btn">ORDER ONLINE</a>
        </div>
        <!-- / Top slider content -->
      </div>
      <!-- / Top slider single slide -->
      <!-- Top slider single slide -->
      <div class="mu-top-slider-single">
        <img src="assets/img/slider/banner_3.png" alt="img">
        <!-- Top slider content -->
        <div class="mu-top-slider-content">
          <span class="mu-slider-small-title">Delicious Pizza</span>
          <h2 class="mu-slider-title">Get it any way you want just for 5€</h2>
          <p>Pizza is life</p>
          <a href="#mu-restaurant-menu" class="mu-readmore-btn">ORDER ONLINE</a>
        </div>
        <!-- / Top slider content -->
      </div>
      <!-- / Top slider single slide -->
    </div>
  </div>
</section>
<!-- End slider  -->

<!-- Start About us -->
<section id="mu-about-us">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-about-us-area">
          <div class="mu-title">
            <span class="mu-subtitle">Discover</span>
            <h2>ABOUT US</h2>
            <i class="fa fa-spoon"></i>
            <span class="mu-title-bar"></span>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mu-about-us-left">
                <p>It all started in 1972, when owner Judy Waller opened her first U.S. Pizza Company in a burned out
                  clock shop in Levy, AR. Armed with
                  a unique recipe for thin crust pizza and an old fashioned stone hearth oven, U.S. Pizza embarked on a
                  quarter-of-a-century journey
                  that has done everything but dwindle.That first store grossed only about $1,000 per week, but ten
                  other U.S. Pizza Company locations
                  have opened since. In addition to the chain of U.S. Pizza Companies, in 1981, Judy opened Hillcrest
                  Liquor Store on Kavanaugh Boulevard
                  in Little Rock.Since we opened our first store in 1972, we’ve been making our thin crust pizza from
                  scratch when you order it. And we
                  still use stone hearth ovens. That’s one of the reasons our unique pizzas are worth the wait!We pride
                  ourselves in offering you the
                  very best pizza, salads and sandwiches, and we value your patronage. With more than 44 years of
                  experience under our belts,
                  we understand how to best serve our customers through tried and true service principles. Instead of
                  following trends, we set them.
                  We create food we’re proud to serve and deliver it fast, with a smile. If you’re looking for a reason
                  not to cook, need a place to
                  watch the game with friends, or spending time with family, we’ve made sure there’s something for
                  everybody.</p>

              </div>
            </div>
            <div class="col-md-6">
              <div class="mu-about-us-right">
                <ul class="mu-abtus-slider">
                  <li><img src="http://i68.tinypic.com/2m85mq8.png" alt="img"></li>
                  <li><img src="assets/img/about-us/about_us1.jpg" alt="img"></li>
                  <li><img src="assets/img/about-us/about_us2.jpg" alt="img"></li>
                  <!--<li><img src="http://i68.tinypic.com/2m85mq8.png" alt="img"></li>-->
                  <!--<li><img src="http://i68.tinypic.com/2m85mq8.png" alt="img"></li>-->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End About us -->

<!-- Start Counter Section -->
<section id="mu-counter">
  <div class="mu-counter-overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-counter-area">
            <ul class="mu-counter-nav">
              <li class="col-md-3 col-sm-3 col-xs-12">
                <div class="mu-single-counter">
                  <span>Fresh</span>
                  <h3><span class="counter">55</span><sup>+</sup></h3>
                  <p>Breakfast Items</p>
                </div>
              </li>
              <li class="col-md-3 col-sm-3 col-xs-12">
                <div class="mu-single-counter">
                  <span>Delicious</span>
                  <h3><span class="counter">130</span><sup>+</sup></h3>
                  <p>Lunch Items</p>
                </div>
              </li>
              <li class="col-md-3 col-sm-3 col-xs-12">
                <div class="mu-single-counter">
                  <span>Hot</span>
                  <h3><span class="counter">35</span><sup>+</sup></h3>
                  <p>Coffee Items</p>
                </div>
              </li>
              <li class="col-md-3 col-sm-3 col-xs-12">
                <div class="mu-single-counter">
                  <span>Satisfied</span>
                  <h3><span class="counter">3562</span><sup>+</sup></h3>
                  <p>Customers</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Counter Section -->

<!-- Start Restaurant Menu -->
<section id="mu-restaurant-menu">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-restaurant-menu-area">
          <div class="mu-title">
            <span class="mu-subtitle">Discover</span>
            <h2>OUR MENU</h2>
            <i class="fa fa-spoon"></i>
            <span class="mu-title-bar"></span>
          </div>
          <?php if ($user_home->is_logged_in()) { ?>
            <div class="currencyButtons">
              <button style="font-size:18px" onclick="updatePrice('euro')"><i class="fa fa-euro"></i></button>
              <button style="font-size:18px" onclick="updatePrice('gbp')"><i class="fa fa-gbp"></i></button>
              <button style="font-size:18px" onclick="updatePrice('dollar')"><i class="fa fa-dollar"></i></button>
            </div>
          <?php } ?>
          <div class="mu-restaurant-menu-content">
            <ul class="nav nav-tabs mu-restaurant-menu">
              <?php
              $categories = $session->getCategory();
              $isActive = ' class="active" ';
              foreach ($categories as $key => $value) {
                echo '<li' . $isActive . '><a href="#category-' . $value['c_id'] . '" data-toggle="tab">' . $value['c_name'] . '</a></li>';
                $isActive = '';
              }
              ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <?php foreach ($categories as $key => $value): ?>
              <div class="tab-pane fade in <?= $key == 0 ? 'active' : '' ?>" id="category-<?= $value['c_id'] ?>">
                <div class="mu-tab-content-area">
                  <div class="row">
                    <?php
                    if ($value['c_name'] == "Daily Offers"){
                    ?>
                    <div class="col-md-12">
                      <div class="mu-tab-content-left">
                        <ul class="mu-menu-item-nav">
                          <?php
                          $dailyOffers = $session->getDailyOffers();
                          foreach ($dailyOffers as $key => $value) {
                          $dailyOfferId = $value['DailyId'];
                          ?>
                          <li class="media-double">
                            <div class="media">
                              <div class="media-left">
                                <div>
                                  <?php
                                  echo '<img class="media-object" src="includes/drinks_images/' . $value['D_Photo'] . '" alt="img">';
                                  echo '<img class="media-object" src="includes/pizza_images/' . $value['p_photo'] . '" alt="img">';
                                  ?>
                                </div>
                              </div>
                              <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo $value['DO_Name']; ?></a></h4>
                                <?php
                                if ($user_home->is_logged_in()) {
                                  echo $value['name'] . ' ' . $value['p_name'] . ' and ' . $value['D_Name'] . ' only for <span class="mu-menu-price currency" data-pizza-id="' . $dailyOfferId . '" data-pizza-price="' . $value['DO_Price'] . '">$' . $value['DO_Price'] . '</span>';
                                } else {
                                  echo $value['name'] . ' ' . $value['p_name'] . ' and ' . $value['D_Name'] . '<span class="mu-menu-price currency" data-pizza-id="' . $dailyOfferId . '" data-pizza-price="MustBeLoggedIn"><h6 style=color:red>Prices are visible for logged in users!</h6></span>';
                                }
                                ?>
                              </div>

                              <div class="basket-options">
                                <form action="cart.php" method="post">
                                  <div class="input-stepper">
                                    <button type="button" data-input-stepper-decrease>-</button>
                                    <input type="text" name="qty-deal-<?= $dailyOfferId ?>"
                                           id="qty-deal-<?= $dailyOfferId ?>" value="1">
                                    <button type="button" data-input-stepper-increase>+</button>
                                  </div>
                                  <?php if ($user_home->is_logged_in()) { ?>
                                    <button type="submit" class="add-to-basket"
                                            onclick="addToCart(event, undefined, $('#qty-deal-<?= $dailyOfferId ?>').val(), undefined, <?= $dailyOfferId ?>)">
                                      Add to cart
                                    </button>
                                  <?php } ?>
                                </form>
                              </div>
                              <?php
                              }
                              }
                              else {
                                $pizzas = $session->getPizzasForCategory($value['c_id']);
                                foreach ($pizzas as $key => $value) {
                                  $pizzaId = $value['p_id'];
                                  ?>
                                  <div class="col-md-6">
                                    <div class="mu-tab-content-left">
                                      <ul class="mu-menu-item-nav">
                                        <li>
                                          <div class="media">
                                            <div class="media-left">
                                              <a href="#">
                                                <?php
                                                echo '<img class="media-object" src="includes/pizza_images/' . $value['p_photo'] . '"" alt="img">';
                                                ?>
                                              </a>
                                            </div>
                                            <div class="media-body">
                                              <h4 class="media-heading"><a href="#"><?php echo $value['p_name']; ?></a>
                                              </h4>
                                              <?php

                                              // echo $pizzaId;
                                              if ($user_home->is_logged_in()) {
                                                $prices = $session->getPizzaPrices($pizzaId);
                                                foreach ($prices as $key => $value) {
                                                  echo $value['name'] . ' <span class="mu-menu-price currency" data-pizza-id="' . $pizzaId . '" data-pizza-price="' . $value['price'] . '">$' . $value['price'] . '</span>';
                                                }
                                              } else {
                                                echo '<h6 style=color:red>Prices are visible for logged in users!</h6>';
                                              }

                                              $ingredientsRaw = $session->getPizzaIngredients($pizzaId);

                                              $ingredients = [];
                                              foreach ($ingredientsRaw as $ingredient) {
                                                array_push($ingredients, $ingredient['i_name']);
                                              }

                                              $ingredientsFormatted = join(' | ', $ingredients); // this will concatenate each ingredient to A | B | C

                                              ?>
                                              <p></p>
                                              <p><?php echo $ingredientsFormatted; ?>.</p>
                                            </div>
                                          </div>

                                          <div class="basket-options">
                                            <form action="#" method="post">
                                              <div class="input-stepper">
                                                <button type="button" data-input-stepper-decrease>-</button>
                                                <input type="text" name="qty-<?= $pizzaId ?>" id="qty-<?= $pizzaId ?>"
                                                       value="1">
                                                <button type="button" data-input-stepper-increase>+</button>
                                              </div>

                                              <?php

                                              $prices = $session->getPizzaPrices($pizzaId);
                                              ?>
                                              <select name="pizza-size-<?= $pizzaId ?>" id="pizza-size-<?= $pizzaId ?>">
                                                <?php
                                                foreach ($prices as $key => $value) {
                                                  echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';

                                                }
                                                ?>
                                                <select>
                                                  <?php if ($user_home->is_logged_in()) { ?>
                                                    <button type="submit" class="add-to-basket"
                                                            onclick="addToCart(event, $('#pizza-size-<?= $pizzaId ?>').val(), $('#qty-<?= $pizzaId ?>').val(), <?= $pizzaId ?>)">
                                                      Add to cart
                                                    </button>
                                                  <?php } ?>
                                            </form>
                                          </div>

                                        </li>

                                      </ul>
                                    </div>
                                  </div>
                                <?php }
                              }// pizza ?>
                            </div>
                      </div>
                    </div>
                    <?php endforeach; // category ?>
                    <!--div class="tab-pane fade " id="meals">
                      <div class="mu-tab-content-area">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mu-tab-content-left">
                              <ul class="mu-menu-item-nav">
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/veggiepizza/Margherita.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Margherita</a></h4>
                                      <span class="mu-menu-price">$10.99</span>
                                      <p>Loaded with extra cheese!.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/veggiepizza/Deluxeveggie.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Deluxe Veggie</a></h4>
                                      <span class="mu-menu-price">$11.99</span>
                                      <p>Onion | Crisp Capsicum | Mushroom | Golden Corn | Paneer.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/veggiepizza/Countryspecial.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Country Special</a></h4>
                                      <span class="mu-menu-price">$9.99</span>
                                      <p>Onion | Crisp Capsicum | Fresh Tomato.</p>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mu-tab-content-right">
                              <ul class="mu-menu-item-nav">
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/veggiepizza/Cloud9.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Cloud 9</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Onion | Tomato | Babycorn | Paneer | Crisp Capsicum | Jalapeno.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/veggiepizza/VeggieParadise.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Veggie Paradise</a></h4>
                                      <span class="mu-menu-price">$11.95</span>
                                      <p>Babycorn | Black Olives | Crisp Capsicum | Red Paprika.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/veggiepizza/Farmhouse.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Farm House</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Onion | Crisp Capsicum | Mushroom | Fresh Tomato.</p>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div-->
                    <!--div class="tab-pane fade " id="snacks">
                      <div class="mu-tab-content-area">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mu-tab-content-left">
                              <ul class="mu-menu-item-nav">
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-5.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">English Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-6.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Chines Breakfast</a></h4>
                                      <span class="mu-menu-price">$11.95</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-5.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Indian Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mu-tab-content-right">
                              <ul class="mu-menu-item-nav">
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-5.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">English Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-6.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Chines Breakfast</a></h4>
                                      <span class="mu-menu-price">$11.95</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-5.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Indian Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div-->
                    <!--<div class="tab-pane fade " id="desserts">
                      <div class="mu-tab-content-area">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mu-tab-content-left">
                              <ul class="mu-menu-item-nav">
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-7.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">English Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                 <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-8.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Chines Breakfast</a></h4>
                                      <span class="mu-menu-price">$11.95</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                 <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-7.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Indian Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                         <div class="col-md-6">
                           <div class="mu-tab-content-right">
                              <ul class="mu-menu-item-nav">
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-8.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">English Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                 <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-7.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Chines Breakfast</a></h4>
                                      <span class="mu-menu-price">$11.95</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                 <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-8.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Indian Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                           </div>
                         </div>
                       </div>
                     </div>
                    </div>-->
                    <!--div class="tab-pane fade " id="drinks">
                      <div class="mu-tab-content-area">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mu-tab-content-left">
                              <ul class="mu-menu-item-nav">
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/drinks/7up.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">7 UP</a></h4>
                                      <span class="mu-menu-price">$2</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/drinks/Cocacola.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Coca Cola</a></h4>
                                      <span class="mu-menu-price">$11.95</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/drinks/FantaOrange.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Fanta Orange</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mu-tab-content-right">
                              <ul class="mu-menu-item-nav">
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/drinks/Fanta2.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Fanta Exotic</a></h4>
                                      <span class="mu-menu-price">$2</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/drinks/FantaGrape.png" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Fanta Grape</a></h4>
                                      <span class="mu-menu-price">$11.95</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="assets/img/menu/item-9.jpg" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#">Indian Breakfast</a></h4>
                                      <span class="mu-menu-price">$15.85</span>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nulla aliquid praesentium dolorem commodi illo.</p>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</section>
<!-- End Restaurant Menu -->

<!-- Start Reservation section -->
<!--  <section id="mu-reservation">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-reservation-area">
           <div class="mu-title">
             <span class="mu-subtitle">Make A</span>
             <h2>Reservation</h2>
             <i class="fa fa-spoon"></i>
             <span class="mu-title-bar"></span>
           </div>
           <div class="mu-reservation-content">
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione quidem autem iusto, perspiciatis, amet, quaerat blanditiis ducimus eius recusandae nisi aut totam alias consectetur et.</p>
             <form class="mu-reservation-form">
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <input type="text" class="form-control" placeholder="Full Name">
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <input type="email" class="form-control" placeholder="Email">
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <input type="text" class="form-control" placeholder="Phone Number">
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <select class="form-control">
                       <option value="0">How Many?</option>
                       <option value="1 Person">1 Person</option>
                       <option value="2 People">2 People</option>
                       <option value="3 People">3 People</option>
                       <option value="4 People">4 People</option>
                       <option value="5 People">5 People</option>
                       <option value="6 People">6 People</option>
                       <option value="7 People">7 People</option>
                       <option value="8 People">8 People</option>
                       <option value="9 People">9 People</option>
                       <option value="10 People">10 People</option>
                     </select>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <input type="text" class="form-control" id="datepicker" placeholder="Date">
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <input type="text" class="form-control" placeholder="Phone No">
                   </div>
                 </div>
                 <div class="col-md-12">
                   <div class="form-group">
                     <textarea class="form-control" cols="30" rows="10" placeholder="Your Message"></textarea>
                   </div>
                 </div>
                 <button type="submit" class="mu-readmore-btn">Make Reservation</button>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End Reservation section -->

<!-- Start Gallery -->
<section id="mu-gallery">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-gallery-area">
          <div class="mu-title">
            <span class="mu-subtitle">Discover</span>
            <h2>Our Gallery</h2>
            <i class="fa fa-spoon"></i>
            <span class="mu-title-bar"></span>
          </div>
          <div class="mu-gallery-content">

            <!-- Start gallery image -->
            <div class="mu-gallery-body">
              <!-- start single gallery image -->
              <div class="mu-single-gallery col-md-4">


                <?php
                $galleries = $session->getGalleries();

                foreach ($galleries as $key => $value) {
                $galleryId = $value['g_id'];

                ?>

                <div class="mu-single-gallery-item">
                  <?php
                  echo '<figure class="mu-single-gallery-img">
	                    
                       <a href="#"><img alt="img" src="includes/gallery_images/' . $value['g_photo'] . '"></a>
	                    </figure>
	                    <div class="mu-single-gallery-info">
	                      	<a href="#" class="mu-view-btn">
	                        	<img src="assets/img/plus.png" alt="plus icon img">
	                      	</a>
	                       <div class="portfolio-detail">
			                    <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
			                    <img src="includes/gallery_images/' . $value['g_photo'] . '" alt="img-1" />
			                    <h2> ' . $value['g_title'] . '</h2>
			                    <p>' . $value['g_description'] . '</p>
			                    
			                </div>
	                    </div>                  
                  	</div>';
                  ?>
                  <?php } ?>
                </div>


                <!-- End single gallery image -->
                <!-- start single gallery image -->
                <!-- <div class="mu-single-gallery col-md-4">
                  	<div class="mu-single-gallery-item">
	                    <figure class="mu-single-gallery-img">
	                      <a href="#"><img alt="img" src="assets/img/gallery/small/2.jpg"></a>
	                    </figure>
	                    <div class="mu-single-gallery-info">
	                      	<a href="#" class="mu-view-btn">
	                        	<img src="assets/img/plus.png" alt="plus icon img">
	                      	</a>
	                       <div class="portfolio-detail">
			                    <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
			                    <img src="assets/img/gallery/big/2.jpg" alt="img-2" />
			                    <h2>Gallery Item Title</h2>
			                    <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			                    <a href="#" class="view-project-btn">Live Demo</a>
			                </div>
	                    </div>                     
					</div>
                </div>         -->
                <!-- End single gallery image -->
                <!-- start single gallery image -->
                <!--  <div class="mu-single-gallery col-md-4">
                     <div class="mu-single-gallery-item">
                      <figure class="mu-single-gallery-img">
                         <a href="#"><img alt="img" src="assets/img/gallery/small/3.jpg"></a>
                       </figure>
                       <div class="mu-single-gallery-info">
                           <a href="#" class="mu-view-btn">
                             <img src="assets/img/plus.png" alt="plus icon img">
                           </a>
                          <div class="portfolio-detail">
                           <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
                           <img src="assets/img/gallery/big/3.jpg" alt="img-3" />
                           <h2>Gallery Item Title</h2>
                           <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                           <a href="#" class="view-project-btn">Live Demo</a>
                       </div>
                       </div>
           </div>
                 </div>         -->
                <!-- End single gallery image -->
                <!-- start single gallery image -->
                <!--   <div class="mu-single-gallery col-md-4">
                      <div class="mu-single-gallery-item">
                        <figure class="mu-single-gallery-img">
                          <a href="#"><img alt="img" src="assets/img/gallery/small/4.jpg"></a>
                        </figure>
                       <div class="mu-single-gallery-info">
                            <a href="#" class="mu-view-btn">
                              <img src="assets/img/plus.png" alt="plus icon img">
                            </a>
                           <div class="portfolio-detail">
                            <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
                            <img src="assets/img/gallery/big/4.jpg" alt="img-4" />
                            <h2>Gallery Item Title</h2>
                            <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <a href="#" class="view-project-btn">Live Demo</a>
                        </div>
                        </div>
            </div>
                  </div> -->
                <!-- End single gallery image -->
                <!-- start single gallery image -->
                <!--   <div class="mu-single-gallery col-md-4">
                      <div class="mu-single-gallery-item">
                        <figure class="mu-single-gallery-img">
                          <a href="#"><img alt="img" src="assets/img/gallery/small/5.jpg"></a>
                        </figure>
                        <div class="mu-single-gallery-info">
                            <a href="#" class="mu-view-btn">
                              <img src="assets/img/plus.png" alt="plus icon img">
                            </a>
                           <div class="portfolio-detail">
                            <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
                            <img src="assets/img/gallery/big/5.jpg" alt="img-5" />
                            <h2>Gallery Item Title</h2>
                            <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <a href="#" class="view-project-btn">Live Demo</a>
                        </div>
                        </div>
            </div>
                  </div>     -->
                <!-- End single gallery image -->
                <!-- start single gallery image -->
                <!--  <div class="mu-single-gallery col-md-4">
                     <div class="mu-single-gallery-item">
                       <figure class="mu-single-gallery-img">
                         <a href="#"><img alt="img" src="assets/img/gallery/small/6.jpg"></a>
                       </figure>
                       <div class="mu-single-gallery-info">
                           <a href="#" class="mu-view-btn">
                             <img src="assets/img/plus.png" alt="plus icon img">
                           </a>
                          <div class="portfolio-detail">
                           <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
                           <img src="assets/img/gallery/big/6.jpg" alt="img-6" />
                           <h2>Gallery Item Title</h2>
                           <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                           <a href="#" class="view-project-btn">Live Demo</a>
                       </div>
                       </div>
           </div>
                 </div> -->
                <!-- End single gallery image -->
                <!-- start single gallery image -->
                <!--  <div class="mu-single-gallery col-md-4">
                     <div class="mu-single-gallery-item">
                       <figure class="mu-single-gallery-img">
                         <a href="#"><img alt="img" src="assets/img/gallery/small/7.jpg"></a>
                       </figure>
                       <div class="mu-single-gallery-info">
                           <a href="#" class="mu-view-btn">
                             <img src="assets/img/plus.png" alt="plus icon img">
                           </a>
                          <div class="portfolio-detail">
                           <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
                           <img src="assets/img/gallery/big/7.jpg" alt="img-7" />
                           <h2>Gallery Item Title</h2>
                           <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                           <a href="#" class="view-project-btn">Live Demo</a>
                       </div>
                       </div>
           </div>
                 </div>  -->
                <!-- End single gallery image -->
                <!-- start single gallery image -->
                <!-- <div class="mu-single-gallery col-md-4">                  
                  	<div class="mu-single-gallery-item">
	                   <figure class="mu-single-gallery-img">
	                      <a href="#"><img alt="img" src="assets/img/gallery/small/8.jpg"></a>
	                    </figure>
	                    <div class="mu-single-gallery-info">
	                      	<a href="#" class="mu-view-btn">
	                        	<img src="assets/img/plus.png" alt="plus icon img">
	                      	</a>
	                        <div class="portfolio-detail">
			                    <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
			                    <img src="assets/img/gallery/big/8.jpg" alt="img-8" />
			                    <h2>Gallery Item Title</h2>
			                    <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			                    <a href="#" class="view-project-btn">Live Demo</a>
			                </div>
	                    </div>     
					</div>
                </div>      -->
                <!-- End single gallery image -->
                <!-- start single gallery image -->
                <!-- <div class="mu-single-gallery col-md-4">                  
                  	<div class="mu-single-gallery-item">
	                    <figure class="mu-single-gallery-img">
	                      <a href="#"><img alt="img" src="assets/img/gallery/small/9.jpg"></a>
	                    </figure>
	                    <div class="mu-single-gallery-info">
	                      	<a href="#" class="mu-view-btn">
	                        	<img src="assets/img/plus.png" alt="plus icon img">
	                      	</a>
	                       <div class="portfolio-detail">
			                    <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
			                    <img src="assets/img/gallery/big/9.jpg" alt="img-9" />
			                    <h2>Gallery Item Title</h2>
			                    <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			                    <a href="#" class="view-project-btn">Live Demo</a>
			                </div>
	                    </div>                       
					</div>
                </div> -->
                <!-- End single gallery image -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<!-- End Gallery -->

<!-- Start Client Testimonial section -->
<!-- <section id="mu-client-testimonial">
  <div class="mu-overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-client-testimonial-area">
            <div class="mu-title">
              <span class="mu-subtitle">Testimonials</span>
              <h2>What Customers Say</h2>
              <i class="fa fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div> -->
<!-- testimonial content -->
<!--               <div class="mu-testimonial-content">
 -->                <!-- testimonial slider -->
<!-- <ul class="mu-testimonial-slider">
  <li>
    <div class="mu-testimonial-single">
      <div class="mu-testimonial-info">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequuntur ducimus cumque iure modi nesciunt recusandae eligendi vitae voluptatibus, voluptatum tempore, ipsum nisi perspiciatis. Rerum nesciunt fuga ab natus, dolorem?</p>
      </div>
      <div class="mu-testimonial-bio">
        <p>- David Muller</p>
      </div>
    </div>
  </li>
   <li>
    <div class="mu-testimonial-single">
      <div class="mu-testimonial-info">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequuntur ducimus cumque iure modi nesciunt recusandae eligendi vitae voluptatibus, voluptatum tempore, ipsum nisi perspiciatis. Rerum nesciunt fuga ab natus, dolorem?</p>
      </div>
      <div class="mu-testimonial-bio">
        <p>- David Muller</p>
      </div>
    </div>
  </li>
   <li>
    <div class="mu-testimonial-single">
      <div class="mu-testimonial-info">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequuntur ducimus cumque iure modi nesciunt recusandae eligendi vitae voluptatibus, voluptatum tempore, ipsum nisi perspiciatis. Rerum nesciunt fuga ab natus, dolorem?</p>
      </div>
      <div class="mu-testimonial-bio">
        <p>- David Muller</p>
      </div>
    </div>
  </li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</section> -->
<!-- End Client Testimonial section -->

<!-- Start Subscription section -->
<!-- <section id="mu-subscription">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-subscription-area">
          <form class="mu-subscription-form">
            <input type="text" placeholder="Type Your Email Address">
            <button class="mu-readmore-btn" type="Submit">SUBSCRIBE</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- End Subscription section -->

<!-- Start Chef Section -->
<!-- <section id="mu-chef">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-chef-area">
          <div class="mu-title">
            <span class="mu-subtitle">Our Professionals</span>
            <h2>MASTER CHEFS</h2>
            <i class="fa fa-spoon"></i>
            <span class="mu-title-bar"></span>
          </div>
          <div class="mu-chef-content">
            <ul class="mu-chef-nav">
              <li>
                <div class="mu-single-chef">
                  <figure class="mu-single-chef-img">
                    <img src="assets/img/chef/chef-6.jpg" alt="chef img">
                  </figure>
                  <div class="mu-single-chef-info">
                    <h4>Simon Jonson</h4>
                    <span>Head Chef</span>
                  </div>
                  <div class="mu-single-chef-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </li>
              <li>
                <div class="mu-single-chef">
                  <figure class="mu-single-chef-img">
                    <img src="assets/img/chef/chef-2.jpg" alt="chef img">
                  </figure>
                  <div class="mu-single-chef-info">
                    <h4>Kelly Wenzel</h4>
                    <span>Pizza Chef</span>
                  </div>
                  <div class="mu-single-chef-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </li>
              <li>
                <div class="mu-single-chef">
                  <figure class="mu-single-chef-img">
                    <img src="assets/img/chef/chef-3.jpg" alt="chef img">
                  </figure>
                  <div class="mu-single-chef-info">
                    <h4>Greg Hong</h4>
                    <span>Grill Chef</span>
                  </div>
                  <div class="mu-single-chef-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </li>
              <li>
                <div class="mu-single-chef">
                  <figure class="mu-single-chef-img">
                    <img src="assets/img/chef/chef-5.jpg" alt="chef img">
                  </figure>
                  <div class="mu-single-chef-info">
                    <h4>Marty Fukuda</h4>
                    <span>Burger Chef</span>
                  </div>
                  <div class="mu-single-chef-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </li>
              <li>
                <div class="mu-single-chef">
                  <figure class="mu-single-chef-img">
                    <img src="assets/img/chef/chef-6.jpg" alt="chef img">
                  </figure>
                  <div class="mu-single-chef-info">
                    <h4>Simon Jonson</h4>
                    <span>Head Chef</span>
                  </div>
                  <div class="mu-single-chef-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </li>
              <li>
                <div class="mu-single-chef">
                  <figure class="mu-single-chef-img">
                    <img src="assets/img/chef/chef-2.jpg" alt="chef img">
                  </figure>
                  <div class="mu-single-chef-info">
                    <h4>Kelly Wenzel</h4>
                    <span>Pizza Chef</span>
                  </div>
                  <div class="mu-single-chef-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </li>
              <li>
                <div class="mu-single-chef">
                  <figure class="mu-single-chef-img">
                    <img src="assets/img/chef/chef-3.jpg" alt="chef img">
                  </figure>
                  <div class="mu-single-chef-info">
                    <h4>Greg Hong</h4>
                    <span>Grill Chef</span>
                  </div>
                  <div class="mu-single-chef-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </li>
              <li>
                <div class="mu-single-chef">
                  <figure class="mu-single-chef-img">
                    <img src="assets/img/chef/chef-5.jpg" alt="chef img">
                  </figure>
                  <div class="mu-single-chef-info">
                    <h4>Marty Fukuda</h4>
                    <span>Burger Chef</span>
                  </div>
                  <div class="mu-single-chef-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- End Chef Section -->

<!-- Start Latest News -->
<!-- <section id="mu-latest-news">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-latest-news-area">
          <div class="mu-title">
            <span class="mu-subtitle">Latest News</span>
            <h2>FROM OUR BLOG</h2>
            <i class="fa fa-spoon"></i>
            <span class="mu-title-bar"></span>
          </div>
          <div class="mu-latest-news-content">
            <div class="row">
              <!-- start single blog -->
<!--  <div class="col-md-6">
   <article class="mu-news-single">
     <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, distinctio!</a></h3>
     <figure class="mu-news-img">
       <a href="#"><img src="assets/img/news/1.jpg" alt="img"></a>
     </figure>
     <div class="mu-news-single-content">
       <ul class="mu-meta-nav">
         <li>By Admin</li>
         <li>Date: May 10 2016</li>
       </ul>
       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio est quaerat magnam exercitationem voluptas, voluptatem sed quam ab laborum voluptatum tempore dolores itaque, molestias vitae.</p>
       <div class="mu-news-single-bottom">
         <a href="blog-single.html" class="mu-readmore-btn">Read More</a>
       </div>
     </div>
   </article>
 </div> -->
<!-- start single blog -->
<!--  <div class="col-md-6">
   <article class="mu-news-single">
     <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, distinctio!</a></h3>
     <figure class="mu-news-img">
       <a href="#"><img src="assets/img/news/2.jpg" alt="img"></a>
     </figure>
     <div class="mu-news-single-content">
       <ul class="mu-meta-nav">
         <li>By Admin</li>
         <li>Date: May 10 2016</li>
       </ul>
       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio est quaerat magnam exercitationem voluptas, voluptatem sed quam ab laborum voluptatum tempore dolores itaque, molestias vitae.</p>
       <div class="mu-news-single-bottom">
         <a href="blog-single.html" class="mu-readmore-btn">Read More</a>
       </div>
     </div>
   </article>
 </div>
</div>
<!-- Start brows more btn -->
<!--               <a href="blog-archive.html" class="mu-browsmore-btn">BROWS MORE</a>
 -->              <!-- End brows more btn -->
<!--  </div>
</div>
</div>
</div>
</div>
</section>  -->
<!-- End Latest News -->

<!-- Start Contact section -->
<section id="mu-contact">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-contact-area">
          <div class="mu-title">
            <span class="mu-subtitle">Get In Touch</span>
            <h2>Contact Us</h2>
            <i class="fa fa-spoon"></i>
            <span class="mu-title-bar"></span>
          </div>
          <div class="mu-contact-content">
            <div class="row">
              <div class="col-md-6">
                <div class="mu-contact-left">
                  <form class="mu-contact-form" action="includes/process.php" method="POST">
                    <div class="form-group">
                      <label for="name">Your Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group">
                      <label for="subject">Subject</label>
                      <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject"
                             required>
                    </div>
                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea class="form-control" id="message" cols="30" rows="10" placeholder="Type Your Message"
                                name="message" required></textarea>
                    </div>
                    <button type="submit" class="mu-send-btn" name="action" value="sendMessage">Send Message</button>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mu-contact-right">
                  <div class="mu-contact-widget">
                    <h3>Office Address</h3>
                    <p>We always aim to provide a great experience, but if we didn’t get it right this time, then we are
                      here to help. We love hearing from our guest and neighbors.
                      Please use this form to let us know what's on your mind. We'll get back to you as soon as
                      possible.</p>
                    <address>
                      <p><i class="fa fa-phone"></i> (+383) 44 123-456 </p>
                      <p><i class="fa fa-envelope-o"></i>contact@grandmapizzas.com</p>
                      <p><i class="fa fa-map-marker"></i>Lagja Kalabria pn, Prishtine, Kosove</p>
                    </address>
                  </div>
                  <div class="mu-contact-widget">
                    <h3>Open Hours</h3>
                    <address>
                      <p><span>Monday - Friday</span> 7.00 am to 12 pm</p>
                      <p><span>Saturday</span> 8.00 am to 10 pm</p>
                      <p><span>Sunday</span> 9.00 am to 12 pm</p>
                    </address>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Contact section -->

<!-- Start Map section -->
<section id="mu-map">
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2934.6588197205488!2d21.150674515128237!3d42.6473923791686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549e8d5d607f25%3A0xa31dd05b21bd09de!2sUniversity+for+Business+and+Technology!5e0!3m2!1sen!2s!4v1479229117993"
    width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
</section>
<!-- End Map section -->

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
