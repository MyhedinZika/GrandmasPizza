<?php
include('includes/session.php');
//session_start();
require_once 'includes/class.user.php';
$user_home = new USER();


if ($user_home->is_logged_in()) {
  $stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
  $stmt->execute(array(":uid" => $_SESSION['userSession']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $userId = $row['userID'];

  // get order id
  $order = $session->getOrderId($userId);

  if ($order == null) {
    // create new empty order
    try {
      $session->createCart($userId);
    } catch (Exception $e) {
      http_response_code(500);
      echo $e->getMessage();
      exit();
    }

    $order = $session->getOrderId($userId);
  }

  if (is_array($order)) {
    if (isset($_POST['Pizza_IdFK'])) {
      try {
        $session->addPizzaToOrder($order['Order_Id'], $_POST['Size'], $_POST['Pizza_IdFK'], $_POST['Quantity']);
      } catch (Exception $e) {
        http_response_code(500);
        echo $e->getMessage();
      }

      echo 'Added Pizza to Cart';
    } else {
      try {
        $session->addDailyDealToOrder($order['Order_Id'], $_POST['DailyIdFK'], $_POST['Quantity']);
      } catch (Exception $e) {
        http_response_code(500);
        echo $e->getMessage();
      }

      echo 'Added Daily Deal to Cart';
    }
  }
}

?>

