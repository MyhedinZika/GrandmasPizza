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
  <title>GrandmasPizza Owner Administration</title>

  <link rel="stylesheet" type="text/css" href="ui/css/admin.css"/>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <style>
    .table-content {
      border-top: #CCCCCC 4px solid;
      width: 50%;
    }

    .table-content th {
      padding: 5px 20px;
      background: #F0F0F0;
      vertical-align: top;
    }

    .table-content td {
      padding: 5px 20px;
      border-bottom: #F0F0F0 1px solid;
      vertical-align: top;
    }
  </style>


</head>


<body>
<?php


if ($user_login->is_logged_in())
{
$userId = $_SESSION['userSession'];
$user = $session->getUser($userId);
if ($user['userAdmin'] == 3)
{


?>
<div id="header" class="page-header">
  <a href="frontPage.php" class="logo-home">
    <img id="logo" src="../ui/images/logo.png" alt="Grandmas Pizza"/>
  </a>

  <h1>GrandmasPizza Owner Administration</h1>

  <div class="navbar">
    <ul class="nav">
      <li class="right"><a href="../" target="_blank">View Live Site</a></li>
      <li class="active"><a href="owner.php">Reports</a>
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
      <li><a href="list-users.php">Users</a></li>
      <li class="right"><a href="../includes/logout.php">Log Out</a></li>
    </ul>
  </div>

</div><!-- /.page-header -->


<div class="page-body">

  <h2> Report </h2>

  <?php

  $post_at = "";
  $post_at_to_date = "";

  $queryCondition = "";
  if (!empty($_POST["search"]["post_at"])) {
    $post_at = $_POST["search"]["post_at"];
    list($fid, $fim, $fiy) = explode("-", $post_at);

    $post_at_todate = date('Y-m-d');
    if (!empty($_POST["search"]["post_at_to_date"])) {
      $post_at_to_date = $_POST["search"]["post_at_to_date"];
      list($tid, $tim, $tiy) = explode("-", $_POST["search"]["post_at_to_date"]);
      $post_at_todate = "$tiy-$tim-$tid";
    }

    $queryCondition .= "WHERE orderDate BETWEEN '$fiy-$fim-$fid' AND '" . $post_at_todate . "'";
  }

  $result = $session->getOrders($queryCondition);
  ?>


  <ul class="items-list clearfix">

    <div class="demo-content">
      <form name="frmSearch" method="post" action="">
        <p class="search_input">
          <input type="text" placeholder="From Date" id="post_at" name="search[post_at]" value="<?php echo $post_at; ?>"
                 class="input-control"/>
          <input type="text" placeholder="To Date" id="post_at_to_date" name="search[post_at_to_date]"
                 style="margin-left:10px" value="<?php echo $post_at_to_date; ?>" class="input-control"/>
          <input type="submit" name="go" value="Search">
        </p>
        <?php if (!empty($result)) { ?>
          <table class="table-content">
            <thead>
            <tr>

              <th width="30%"><span>Order ID</span></th>
              <th width="30%"><span>Order Total</span></th>
              <th width="30%"><span>Order Date</span></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($result as $order) {
              ?>
              <tr>
                <td><?php echo $order["Order_Id"]; ?></td>
                <td><?php echo $order["Total"]; ?></td>
                <td><?php echo $order["orderDate"]; ?></td>

              </tr>
              <?php
            }
            ?>
            <tbody>
          </table>
        <?php } ?>
      </form>
    </div>
    <!-- <?php
    /*            $pizzas = $session->getPizzas();
                            
                foreach ($pizzas as $pizza):
                */
    ?>
				
                <li>
                    <h3><?/*= $pizza['p_name'] */
    ?></h3>

                    <div class="actions">
                        <a class="button icon delete" href="list-pizzas.php?action=delete&p_id=<?/*= $pizza['p_id'] */
    ?>">Delete</a>
                        <a class="button icon edit" href="edit-pizza.php?p_id=<?/*= $pizza['p_id'] */
    ?>">Edit</a>
                    </div>
                </li>
				
            --><?php /*endforeach; */
    ?>
  </ul>

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
<script>
  $.datepicker.setDefaults({
    showOn: "button",
    buttonImage: "datepicker.png",
    buttonText: "Date Picker",
    buttonImageOnly: true,
    dateFormat: 'dd-mm-yy'
  });
  $(function () {
    $("#post_at").datepicker();
    $("#post_at_to_date").datepicker();
  });
</script>

</body>
</html>