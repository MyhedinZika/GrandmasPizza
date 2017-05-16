<?php 
  include('includes/session.php');
  require_once 'includes/class.user.php';
  $user_home = new USER();

  //Kontrollojme a eshte useri i loguar, si dhe e marrim ID'n e userit
	if($user_home->is_logged_in()) {
	$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid"); 
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);


  $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Paypal url
  $merchant_email = 'contactgrandmaspizza-facilitator@gmail.com'; // Seller email
  $cancel_return = "http://grandmaspizza.online-presence.com/checkout.php"; //Cancel Url
  $success_return = "http://grandmaspizza.online-presence.com/success.php"; //Payment Succesful
  
  $userId = $row['userID']; // E ruajme userId ne nje variabel
  $order =$session->getOrderId($userId); //Marrim orderin duke derguar userID

  $totalCosts = $_POST['TotalCost']; //Qmimi total i orderit
 
  $addressOption = $_POST['delivery-addresses']; //Marrim opsionin qe eshte selektuar 

  //Marrim orderin me ane te User ID si dhe me ane te AddressID qe eshte null
  $stmt = $user_home->runQuery("SELECT * from orders where User_Id=:uid AND Status='In_Progress'");
  $stmt->execute(array(":uid"=>$_SESSION['userSession']));
  $userOrder = $stmt->fetch(PDO::FETCH_ASSOC);
  $userOrderId = $userOrder['Order_Id'];

  
  $suborders = $session->getOrderProducts($userOrderId);
   

  if($addressOption === 'new-address' ){
    $userAddress = $session->checkUserAddress($_POST['Address_1'],$_POST['Address_2'],$_POST['City'],$_POST['Postal_Code']);

    if($userAddress === false){
      if(!empty($_POST['Address_1']) && !empty($_POST['Address_2'])){
        $stmt = $database->connection->prepare('INSERT INTO address(Address_1, Address_2, City, Postal_Code) VALUES(:address_1,:address_2,:city,:postal_code)');
        $stmt->bindParam(':address_1',$_POST['Address_1']);
        $stmt->bindParam(':address_2',$_POST['Address_2']);
        $stmt->bindParam(':city',$_POST['City']);
        $stmt->bindParam(':postal_code',$_POST['Postal_Code']);
        $stmt->execute();

        $AddressId = $session->checkUserAddress($_POST['Address_1'],$_POST['Address_2'],$_POST['City'],$_POST['Postal_Code']);
        $addressId = $AddressId['Address_Id'];
        $session->updateOrderAddressPrice($addressId,$userOrderId,$totalCosts);
      }
    }
  else{
	  
      $addressId = $userAddress['Address_Id'];
      $session->updateOrderAddressPrice($addressId,$userOrderId,$totalCosts);
    }
  }
  else{
		echo $addressOption;
       $session->updateOrderAddressPrice($addressOption,$userOrderId,$totalCosts);
  }


  
	?>

 <form name="myform" action="<?php echo $paypal_url; ?>" method="post" target="_top">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="cancel_return" value="<?php echo $cancel_return ?>">
        <input type="hidden" name="return" value="<?php echo $success_return; ?>">
        <input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
        <input type="hidden" name="lc" value="C2">
        <input type="hidden" name="item_name" value="GrandmasPizza Order Id: <?=$userOrderId ?>">
        <input type="hidden" name="item_number" value="<?php echo $userOrderId ?>">
        <input type="hidden" name="amount" value="<?php echo $totalCosts ?>">
        <input type="hidden" name="currency_code" value"USD">
        <input type="hidden" name="button_subtype" value="services">
        <input type="hidden" name="no_note" value="0">
    </form> 
    
    <script type="text/javascript">  
      document.myform.submit();
    </script>
<?php
}
?> 

