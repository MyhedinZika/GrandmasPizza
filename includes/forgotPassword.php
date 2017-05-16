<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if ($user->is_logged_in() != "") {
  $user->redirect('../index.php');
}

if (isset($_POST['btn-submit'])) {
  $email = $_POST['fEmail'];

  $stmt = $user->runQuery("SELECT userID FROM users WHERE userEmail=:email LIMIT 1");
  $stmt->execute(array(":email" => $email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($stmt->rowCount() == 1) {
    $id = base64_encode($row['userID']);
    $code = md5(uniqid(rand()));

    $stmt = $user->runQuery("UPDATE users SET tokenCode=:token WHERE userEmail=:email");
    $stmt->execute(array(":token" => $code, "email" => $email));

    $message = "
				   Hello , $email
				   <br /><br />
				   We got your request to reset your password, if you did this then click the following link to reset your password, if you didn't just ignore this email,
				   <br /><br />
				   Click The Following Link To Reset Your Password 
				   <br /><br />
				   <a href='grandmaspizza.online-presence.com/includes/resetPassword.php?id=$id&code=$code'>click here to reset your password</a>
				   <br /><br />
				   Thank you :)
				   ";
    $subject = "Password Reset";

    $user->send_mail($email, $message, $subject);

    $msg = "<div class='group'>
					We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
			  	</div>";
  } else {
    $msg = "<div class='group' style='color: #a50000'>
					<strong>Sorry!</strong>  This email wasn't found in our database. 
			    </div>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Grandma's Pizza Forgot Password</title>


  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>

  <link rel="stylesheet" href="css/style.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"
          type="text/javascript"></script>

  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
          type="text/javascript"></script>

  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"
          type="text/javascript"></script>


  <script>
    $(function () {

      $("#form-forgotPassword").validate(
        {
          rules: {
            fEmail: {
              required: true,
              email: true
            }
          },
          messages: {
            logintxtemail: {
              required: "Please enter your email!",
              email: "It doesn't look like an email format!"
            }
          }
        });
    });
  </script>
</head>

<body>
<div class="login-wrap" id="login-wrap" style=" min-height: 350px">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
    <label for="tab-1" class="tab">Forgot Password</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up">
    <label for="tab-2" class="tab" onclick="changeSignUp()"></label>

    <div class="login-form">
      <form id="form-forgotPassword" method="post">
        <div class="sign-in-htm">
          <div class="group">
            <label for="user" class="label">Email</label>
            <input id="user" type="text" class="input" name="fEmail">
          </div>
          <?php
          if (isset($msg)) {
            echo $msg;
          }
          ?>
          <div class="group">
            <input type="submit" class="button" name="btn-submit" value="RESET">
          </div>
        </div>
      </form>
    </div>

  </div>
</div>


</body>
</html>