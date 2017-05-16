<?php
include('includes/session.php');
//session_start();
require_once 'includes/class.user.php';
$user_home = new USER();

if ($user_home->is_logged_in()) {
  $products = $session->getOrderProducts($_POST['orderId']);
  ?>
  <tr>
    <th style="color: red;">Product Name</th>
    <th style="color: red;">Price</th>
    <th style="color: red;">Quantity</th>

  </tr>

  <?php
  foreach ($products as $key => $value) {
    if ($value['Pizza_IdFK'] == null) { ?>
      <tr>
        <?php
        $dailyOfferProduct = $session->getDailyOffer($value['DailyIdFK']);

        ?>
        <td class="item-desc"><?= $dailyOfferProduct['DO_Name']; ?></td>
        <td>$<?= $dailyOfferProduct['DO_Price']; ?></td>
        <td><input class="qty-num" name="productQuantity" value="<?= $value['Quantity'] ?>">
      </tr>
      <?php
    } else { ?>
      <tr>
        <?php

        $pizzaProduct = $session->getPizza($value['Pizza_IdFK']);
        $pizzaPrices = $session->getProductPrice($value['Pizza_IdFK'], $value['Size']);
        ?>
        <td class="item-desc"><?= $pizzaProduct['p_name']; ?></td>
        <td><?= $pizzaPrices['price']; ?></td>
        <td><input class="qty-num" name="productQuantity" value="<?= $value['Quantity'] ?>">
      </tr>
      <?php
    }
  }
}
?>