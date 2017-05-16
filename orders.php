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
  <title>GrandmaPizzas | Orders</title>

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
  <script src="assets/js/jquery.min.js"></script>
  <script type="text/javascript">

    $(document).on('click', '.showMore', function () {
      var orderID = $(this).data('orderid');
      $(this).attr('disabled', true);
      var text = $(this).text();
      var request = $(this).data('request');
      if (request == "0") {
        showMore(orderID);
        $(this).data('request', "2");
        $(this).text('Show Less');
      } else if (request == "1") {
        $('#more_' + orderID).fadeIn();
        $(this).data('request', "2");
        $(this).text('Show Less');
      } else {
        $('#more_' + orderID).fadeOut();
        $(this).data('request', "1");
        $(this).text('Show More');
      }
      $(this).attr('disabled', false);
    });

    function showMore(valueID) {

      var cartItemData = {
        orderId: valueID
      };

      $.ajax({
        type: 'POST',
        url: 'showProducts.php',
        data: cartItemData
      }).then(function (data) {
        $('#more_' + valueID).append(data);
        console.log(data);
      }, function (err, x, y) {
        console.log(err, x, y);
        alert('Item couldn\'t be added to cart.');
      });
    }

    function addToCart(event, Size, Quantity, Pizza_IdFK, DailyIdFK) {
      event.preventDefault();


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
          if (!$user_home->is_logged_in()) {
            echo '<li><a href="includes/login.php">LOG IN / SIGN UP</a></li>';
          } else {
            ?>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php">
                <?php echo strtoupper($row['userName']); ?>
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


<!-- Start orders section -->
<?php
if (isset($_POST['action']) && $_POST['action'] === 'accept') {
  // $result = $session->updateOrderToAccepted($_POST['orderId']);
  $sql = "UPDATE orders SET Status = 'Accepted' WHERE Order_Id = :order_id";
  $stmt = $database->connection->prepare($sql);
  $stmt->bindParam('order_id', $_POST['orderId']);
  $stmt->execute();

  $order = $session->getOrderbyId($_POST['orderId']);
  $user = $session->getUser($order['User_Id']);

  $userName = $user['userName'] . str_repeat('&nbsp;', 1) . $user['userSurname'];
  $userEmail = $user['userEmail'];

  $message = "
     Dear $userName,<br/>
     Thanks for ordering at Grandma's Pizza. <br/><br/>
     We'd like to let you know that your order has been accepted  succesfully.
     We hope you keep ordering at our store.<br/><br/>
     Best regards, Grandma's Pizza Staff.
           ";
  $subject = "Your order";
  $user_home->send_mail($userEmail, $message, $subject);

}

if (isset($_POST['action']) && $_POST['action'] === 'done') {
  // $result = $session->updateOrderToAccepted($_POST['orderId']);
  $sql = "UPDATE orders SET Status = 'Completed' WHERE Order_Id = :order_id";
  $stmt = $database->connection->prepare($sql);
  $stmt->bindParam('order_id', $_POST['orderId']);
  $stmt->execute();

}

if (isset($_POST['action']) && $_POST['action'] === 'decline') {
  // $result = $session-> updateOrderToAccepted($_POST['orderId']);
  $sql = "UPDATE orders SET Status = 'Canceled' WHERE Order_Id = :order_id";
  $stmt = $database->connection->prepare($sql);
  $stmt->bindParam('order_id', $_POST['orderId']);
  $stmt->execute();

  $order = $session->getOrderbyId($_POST['orderId']);
  $user = $session->getUser($order['User_Id']);

  $userName = $user['userName'] . str_repeat('&nbsp;', 1) . $user['userSurname'];
  $userEmail = $user['userEmail'];

  $message = "
     Dear $userName,<br/>
     Unfortunately we cannot accept your order at this moment. <br/><br/>
     We'll refund your money.
     Sorry for the inconvenience.<br/><br/>
     Best regards, Grandma's Pizza Staff.";
  $subject = "Your order";
  $user_home->send_mail($userEmail, $message, $subject);
}
?>


<div class="container my-basket">
  <div class="row">
    <div class="col-md-10 col-md-push-1 orders">
      <h1>Orders</h1>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#current">Current</a></li>
        <li><a data-toggle="tab" href="#completed">Completed</a></li>
        <li><a data-toggle="tab" href="#cancelled">Cancelled</a></li>
      </ul>
      <div class="tab-content">
        <div id="current" class="tab-pane fade in active">
          <h2>Pending</h2>
          <form action="#" method="post">
            <div class="order-items table-responsive">
              <table>
                <thead>
                <tr>
                  <th>Order #</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $pendingOrders = $session->getPendingOrders();
                foreach ($pendingOrders as $key => $value)
                {
                $user = $session->getUser($value['User_Id']);
                $userName = $user['userName'] . str_repeat('&nbsp;', 1) . $user['userSurname'];
                $address = $session->getAddress($value['Address_Id']);
                $mainAddress = $address['Address_1'];
                ?>
                <tr>
                  <form class="admin-form" method="post">
                    <input type="hidden" name="orderId" value="<?= $value['Order_Id'] ?>">
                    <td><?= $value['Order_Id'] ?></td>
                    <td><?= $value['Total'] ?></td>
                    <td><?= $value['Status'] ?></td>
                    <td><?= $userName ?></td>
                    <td><?= $mainAddress ?></td>
                    <td>
                      <button type="submit" title="Accept" name="action" value="accept">Accept</button>
                      <button type="submit" title="Decline" name="action" value="decline">Decline</button>
                      <button type="button" class="showMore" data-request="0" data-orderid="<?= $value['Order_Id'] ?>">
                        Show More
                      </button>
                    </td>
                <tbody id="more_<?= $value['Order_Id'] ?>">

                </tbody>
          </form>
          </tr>
          <?php
          }
          ?>
          </tbody>
          </table>
        </div>
        </form>

        <h2>Accepted</h2>
        <form action="#" method="post">
          <div class="order-items table-responsive">
            <table>
              <thead>
              <tr>
                <th>Order #</th>
                <th>Total</th>
                <th>Status</th>
                <th>Name</th>
                <th>Address</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $acceptedOrders = $session->getAcceptedOrders();
              foreach ($acceptedOrders as $key => $value) {
                $user = $session->getUser($value['User_Id']);
                $userName = $user['userName'] . str_repeat('&nbsp;', 1) . $user['userSurname'];
                $address = $session->getAddress($value['Address_Id']);
                $mainAddress = $address['Address_1'];
                ?>
                <tr>
                  <input type="hidden" name="orderId" value="<?= $value['Order_Id'] ?>">
                  <td><?= $value['Order_Id'] ?></td>
                  <td><?= $value['Total'] ?></td>
                  <td><?= $value['Status'] ?></td>
                  <td><?= $userName ?></td>
                  <td><?= $mainAddress ?></td>
                  <td>
                    <button type="submit" title="Done" name="action" value="done">Done</button>
                  </td>
                </tr>
                <?php
              }
              ?>
              </tbody>
            </table>
          </div>
        </form>
      </div>

      <div id="completed" class="tab-pane fade">
        <div class="order-items table-responsive">
          <table>
            <thead>
            <tr>
              <th>Order #</th>
              <th>Total</th>
              <th>Status</th>
              <th>Name</th>
              <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $completedOrders = $session->getCompletedOrders();
            foreach ($completedOrders as $key => $value) {
              $user = $session->getUser($value['User_Id']);
              $userName = $user['userName'] . str_repeat('&nbsp;', 1) . $user['userSurname'];
              $address = $session->getAddress($value['Address_Id']);
              $mainAddress = $address['Address_1'];
              ?>
              <tr>
                <td><?= $value['Order_Id'] ?></td>
                <td><?= $value['Total'] ?></td>
                <td><?= $value['Status'] ?></td>
                <td><?= $userName ?></td>
                <td><?= $mainAddress ?></td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>

      <div id="cancelled" class="tab-pane fade">
        <div class="order-items table-responsive">
          <table>
            <thead>
            <tr>
              <th>Order #</th>
              <th>Total</th>
              <th>Status</th>
              <th>Name</th>
              <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $canceledOrders = $session->getCanceledOrders();
            foreach ($canceledOrders as $key => $value) {
              $user = $session->getUser($value['User_Id']);
              $userName = $user['userName'] . str_repeat('&nbsp;', 1) . $user['userSurname'];
              $address = $session->getAddress($value['Address_Id']);
              $mainAddress = $address['Address_1'];
              ?>
              <tr>
                <td><?= $value['Order_Id'] ?></td>
                <td><?= $value['Total'] ?></td>
                <td><?= $value['Status'] ?></td>
                <td><?= $userName ?></td>
                <td><?= $mainAddress ?></td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- End orders section -->

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