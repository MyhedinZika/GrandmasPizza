<?php
//session_start();
include("../includes/session.php");
require_once 'class.user.php';

ob_start();
$user_login = new USER();

$clientIP = $_SERVER['REMOTE_ADDR'];

$loginAttemptIp = $session->getLoginAttempt($clientIP);
$failedCounter = $loginAttemptIp['failedCounter'];


if (isset($_POST['btn-login'])) {

  $email = trim($_POST['logintxtemail']);
  $upass = trim($_POST['logintxtupass']);
  if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
    $secret = '6LewJRQUAAAAAOy-t9LZh-Cbii4CwaRuOpWw0tyY';
    //$errMsg = $email;
    //get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {
      if ($user_login->login($email, $upass)) {
        $userId = $_SESSION['userSession'];
        $user = $session->getUser($userId);
        $session->deleteIPCounter($clientIP);
        if ($user['userAdmin'] == 0) { //if is just an user redirect to index
          $user_login->redirect('../index.php');
          exit();
        } else if ($user['userAdmin'] == 1) {
          $user_login->redirect('../admin/list-pizzas.php');
          exit();
        } else if ($user['userAdmin'] == 2) {
          $user_login->redirect('../orders.php');
          exit();
        } else { //if admin send to list-pizzas.php
          $user_login->redirect('../admin/owner.php');
          exit();
        }
      }
    }
  } elseif ($failedCounter >= 3) {
    $errMsg = 'Please click on the reCAPTCHA box.';
  } else {
    if ($user_login->login($email, $upass)) {
      $userId = $_SESSION['userSession'];
      $user = $session->getUser($userId);
      $session->deleteIPCounter($clientIP);
      if ($user['userAdmin'] == 0) { //if is just an user redirect to index
        $user_login->redirect('../index.php');
        exit();
      } else if ($user['userAdmin'] == 1) {
        $user_login->redirect('../admin/list-pizzas.php');
        exit();
      } else if ($user['userAdmin'] == 2) {
        $user_login->redirect('../orders.php');
        exit();
      } else { //if admin send to list-pizzas.php
        $user_login->redirect('../admin/owner.php');
        exit();
      }

    }

  }
}
// $counter = 1;
// $session->addLoginAttempts($clientIP, $counter);
// if(isset($_POST['btn-login'])) 
// {
// $loginAtt = $session->getLoginAttempt($clientIP);
// $loginAttCounter = $loginAtt['failedCounter'];
// if($loginAttCounter == 2){
// 	if(isset($_POST['submit'])){
// 		$secret = '6LewJRQUAAAAAOy-t9LZh-Cbii4CwaRuOpWw0tyY';
// 		$response = $_POST['g-recaptcha-response'];
// 		$remoteip = $clientIP;
// 		$url = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
// 		$result = json_decode($url, TRUE);
// 		$recaptchaurl=$url;
// 		if($result['success'] == 1){

// 			$email = trim($_POST['logintxtemail']);
// 			$upass = trim($_POST['logintxtupass']);
// 			if($user_login->login($email,$upass)){
// 				$userId =  $_SESSION['userSession'];
// 				$user = $session->getUser($userId);
// 				$session->deleteIPCounter($clientIP);
// 				if($user['userAdmin'] == 0){
// 					$user_login->redirect('../index.php');
// 	      			  exit();
// 				}
// 				else{
// 					$user_login->redirect('../admin/list-pizzas.php');
// 					exit();
// 				}
// 			}

// 		}
// 	}
// }
// else{

// 	if($user_login->login($email,$upass))
// 	{
// 		$userId =  $_SESSION['userSession'];
// 		$user = $session->getUser($userId);
// 		$session->deleteIPCounter($clientIP);
// 		if($user['userAdmin'] == 0){ //if is just an user redirect to index
// 		   	$user_login->redirect('../index.php');
// 	        exit();
// 		}
// 		else
// 		{ //if admin send to list-pizzas.php
// 			$user_login->redirect('../admin/list-pizzas.php');
// 			exit();
// 		}
// 	}
// // }
// }


$reg_user = new USER();
if ($reg_user->is_logged_in() != "") {
  $reg_user->redirect('../index.php');
}


if (isset($_POST['btn-signup'])) {
  $uname = trim($_POST['txtuname']);
  $surname = trim($_POST['txtsurname']);
  $email = trim($_POST['txtemail']);
  $upass = trim($_POST['txtpass']);
  $confirmPass = trim($_POST['vertxtPass']);
  $phone = trim($_POST['txtphone']);
  $gender = trim($_POST['gender']);
  $code = md5(uniqid(rand()));


  $stmt = $reg_user->runQuery("SELECT * FROM users WHERE userEmail=:email_id");
  $stmt->execute(array(":email_id" => $email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($stmt->rowCount() > 0) {
    $msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  Email already exists , Please Try another one
			  </div>
			  ";
  } else {
    if ($upass == $confirmPass) {
      if ($reg_user->register($uname, $surname, $email, $upass, $gender, $phone, $code)) {
        $id = $reg_user->lasdID();
        $key = base64_encode($id);
        $id = $key;

        $message = "					
							Hello $uname,
							<br /><br />
							Welcome to Grandma's Pizza!<br/>
							To complete your registration  please , just click following link<br/>
							<br /><br />
							<a href='grandmaspizza.online-presence.com/includes/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
							<br /><br />
							Thanks,";

        $subject = "Confirm Registration";

        $reg_user->send_mail($email, $message, $subject);

        $msg = "
						<div class='alert alert-success'>
							<strong>Success!</strong>  We've sent an email to $email.
						Please click on the confirmation link in the email to create your account. 
						</div>
						";

      } else {
        echo "sorry , Query could no execute...";
      }
    } else {
      $msg = "<div class='alert alert-success'>
				  	  <button class='close' data-dismiss='alert'>&times;</button>
					   	<strong>We're sorry.!</strong>  The passwords don't match.
					</div>";

    }
  }
}

// function get_client_ip() {
//     $ipaddress = '';
//     if (isset($_SERVER['HTTP_CLIENT_IP']))
//         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//     else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     else if(isset($_SERVER['HTTP_X_FORWARDED']))
//         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//     else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
//         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//     else if(isset($_SERVER['HTTP_FORWARDED']))
//         $ipaddress = $_SERVER['HTTP_FORWARDED'];
//     else if(isset($_SERVER['REMOTE_ADDR']))
//         $ipaddress = $_SERVER['REMOTE_ADDR'];
//     else
//         $ipaddress = 'UNKNOWN';
//     return $ipaddress;
// }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Grandma's Pizza Login</title>

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <link rel="stylesheet" href="css/style.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
          type="text/javascript"></script>
  <script type="text/javascript"
          src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script>
    $(function () {
      $("#form-signin").validate(
        {
          rules: {
            logintxtemail: {
              required: true,
              email: true
            },
            logintxtupass: {
              required: true
            }
          },
          messages: {
            logintxtemail: {
              required: "Please enter your email!",
              email: "It doesn't look like an email format!"
            },
            logintxtupass: {
              required: "Please enter your password!"
            }
          }
        });
    });
  </script>
  <script>
    $(function () {
      $("#form-signup").validate(
        {
          rules: {
            txtuname: {
              required: true,
              minlength: 3,
              nowhitespace: true,
              lettersonly: true
            },
            txtsurname: {
              required: true,
              minlength: 3,
              nowhitespace: true,
              lettersonly: true
            },
            txtemail: {
              required: true,
              email: true
            },
            txtpass: {
              required: true,
              minlength: 6
            },
            vertxtPass: {
              required: true,
              minlength: 6
            },
            txtphone: {
              required: true,
              digits: true,
              minlength: 6

            },
            gender: {
              required: true
            }
          },
          messages: {
            txtuname: {
              required: "Please enter your First Name!",
              minlength: "Minimum characters are 3!",
              nowhitespace: "Please check if you entered any space in the beggining of your First Name!",
              lettersonly: "Only alphabetic letters allowed!"
            },
            txtsurname: {
              required: "Please enter your Last Name!",
              minlength: "Minimum characters are 3!",
              nowhitespace: "Please check if you entered any space in the beggining of your Last Name!",
              lettersonly: "Only alphabetic letters allowed!"
            },
            txtemail: {
              required: "Please enter your email!",
              email: "It doesn't look like an email format!"
            },
            txtpass: {
              required: "Please enter a password!",
              minlength: "Minimum length of password is 6!"
            },
            vertxtPass: {
              required: "Please retype your new password!",
              minlength: "Minimum length of retyped password is 6!"
            },
            txtphone: {
              required: "You need to enter a phone number!",
              digits: "Only digits are allowed in phone field!",
              minlength: "Minimum length in phone field is 6!"
            },
            gender: {
              required: "Please select a gender!"
            }
          }
        });
    });
  </script>
</head>

<body>
<div class="login-wrap" id="login-wrap" style=" min-height: 500px">
  <?php if (isset($msg)) echo $msg; ?>

  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
    <label for="tab-1" class="tab" onclick="changeLogin()">Sign In</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up">
    <label for="tab-2" class="tab" onclick="changeSignUp()">Sign Up</label>
    <div class="login-form">
      <div class="sign-in-htm">
        <form id="form-signin" method="post">
          <div class="group">
            <label for="email" class="label">Email</label>
            <input id="email" type="email" class="input" name="logintxtemail">
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="pass" type="password" class="input" data-type="password" name="logintxtupass">
          </div>
          <?php
          if (!empty($errMsg)) {
            ?>
            <div class="group" style="color: #a50000">
              <?php echo $errMsg; ?>
            </div>
          <?php } ?>
          <?php
          if (isset($_GET['error'])) {
            // var_dump($recaptchaurl);
            $ipExists = $session->checkIfIpExists($clientIP);
            //var_dump($ipExists);
            if ($ipExists === false) {
              $counter = 1;
              $session->addLoginAttempts($clientIP, $counter);
            } else {
              $loginAttempt = $session->getLoginAttempt($clientIP);
              $loginAttemptCounter = $loginAttempt['failedCounter'];
              if ($loginAttemptCounter < 3) {
                $loginAttemptCounter++;
                $session->updateIpCounter($clientIP, $loginAttemptCounter);
              } else {
                ?>
                <div class="group">
                  <div class="g-recaptcha" data-sitekey="6LewJRQUAAAAADXmLi4TAAhctpTKewzypfCSOpXv">
                  </div>
                </div>
                <?php
              }
            }
            if (empty($errMsg)) {

              ?>
              <div class='group'>
                <strong style="color: #a50000">Wrong Details!</strong>
              </div>
              <?php
            }
          } elseif ($failedCounter >= 3) {
            ?>
            <div class="group">
              <div class="g-recaptcha" data-sitekey="6LewJRQUAAAAADXmLi4TAAhctpTKewzypfCSOpXv">
              </div>
            </div>
            <?php
          }
          ?>
          <?php
          if (isset($_GET['inactive'])) {
            ?>
            <div class='group'>
              <strong style="color: #efe1e1;">Sorry! This Account is not Activated.<br>
                Go to your Inbox and Activate it.</strong>
            </div>
            <?php
          }
          ?>
          <!-- <div class="group">
            <input id="check" type="checkbox" class="check" checked>
            <label for="check"><span class="icon"></span> Keep me Signed in</label>
          </div> -->
          <div class="group">
            <input type="submit" class="button" value="Sign In" name="btn-login">
          </div>
        </form>
        <div class="hr"></div>
        <div class="foot-lnk">
          <a href="forgotPassword.php">Forgot Password?</a>
        </div>
      </div>
      <div class="sign-up-htm">
        <form id="form-signup" method="post">
          <div class="group">
            <label for="name" class="label">First Name</label>
            <input id="name" type="text" class="input" name="txtuname">
          </div>
          <div class="group">
            <label for="lastname" class="label">Last Name</label>
            <input id="lastname" type="text" class="input" name="txtsurname">
          </div>
          <div class="group">
            <label for="email" class="label">Email Address</label>
            <input id="email" type="text" class="input" name="txtemail">
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="pass" type="password" class="input" data-type="password" name="txtpass">
          </div>
          <div class="group">
            <label for="verifypass" class="label">Repeat Password</label>
            <input id="verifypass" type="password" class="input" data-type="password" name="vertxtPass">
          </div>


          <div class="group">
            <label for="phone" class="label">Phone Number</label>
            <input id="phone" type="tel" class="input" name="txtphone">
          </div>
          <div class="group">
            <p>Gender: </p></br>
            M<input type="radio" name="gender" value="M"></br>
            F <input type="radio" name="gender" value="F">
          </div>
          <div class="group">
            <input type="submit" class="button" value="Sign Up" name="btn-signup">
          </div>
        </form>
        <div class="hr"></div>
        <div class="foot-lnk">
          <label for="tab-1" onclick="changeLogin()">Already Member?</label>
        </div>
      </div>
    </div>
  </div>
</div>


</body>
<script>
  function changeSignUp() {
    document.getElementById('login-wrap').style.minHeight = "950px";
  }
  function changeLogin() {
    document.getElementById('login-wrap').style.minHeight = "520px";
  }
</script>
</html>
