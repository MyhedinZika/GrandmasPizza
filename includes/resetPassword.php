<?php
require_once 'class.user.php';
$user = new USER();

if (empty($_GET['id']) && empty($_GET['code'])) {
  $user->redirect('../login.php');
}

if (isset($_GET['id']) && isset($_GET['code'])) {
  $id = base64_decode($_GET['id']);
  $code = $_GET['code'];

  $stmt = $user->runQuery("SELECT * FROM users WHERE userID=:uid AND tokenCode=:token");
  $stmt->execute(array(":uid" => $id, ":token" => $code));
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($stmt->rowCount() == 1) {
    if (isset($_POST['btn-reset-pass'])) {
      $pass = $_POST['pass'];
      $cpass = $_POST['confirmpass'];

      if ($cpass !== $pass) {
        $msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Password Doesn't match. 
						</div>";
      } else {
        $password = password_hash($cpass, PASSWORD_DEFAULT);
        $stmt = $user->runQuery("UPDATE users SET userPassword=:upass WHERE userID=:uid");
        $stmt->execute(array(":upass" => $password, ":uid" => $rows['userID']));

        $msg = "<div class='group'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Password Changed.
						</div>";
        header("refresh:1;login.php");
      }
    }
  } else {
    $msg = "<div class='group' style='color: #a50000'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No Account Found, Try again
				</div>";

  }


}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Day 001 Login Form</title>


  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>

  <link rel="stylesheet" href="css/style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
          type="text/javascript"></script>
  <script type="text/javascript"
          src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>


  <script>
    $(function () {

      $("#resetPassword").validate(
        {
          rules: {
            pass: {
              required: true,
              minlength: true
            },
            confirmpass: {
              required: true
            }
          },
          messages: {
            pass: {
              required: "Please enter your new password",
              minlength: "Minimum length of your new password must be 6 characters!"
            },
            confirmpass: {
              required: "Please retype your new password!"
            }
          }
        });
    });
  </script>

</head>

<body>
<div class="login-wrap" id="login-wrap" style="min-height: 400px">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
    <label for="tab-1" class="tab">Reset Password</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up">
    <label for="tab-2" class="tab" onclick="changeSignUp()"></label>
    <div class="login-form">

      <div class="sign-in-htm">
        <p>Set your new password.</p>
        <form id="resetPassword" method="post">
          <div class="group">
            <label for="user" class="label"></label>
            <input id="user" placeholder="Enter your new password" type="password" class="input" name="pass">
          </div>
          <div class="group">
            <label for="user" class="label"></label>
            <input id="user" placeholder="Retype your new password" type="password" class="input" name="confirmpass">
          </div>
          <?php
          if (isset($msg)) {
            echo $msg;
          }
          ?>
          <div class="group">
            <input type="submit" class="button" name="btn-reset-pass" value="SAVE">
          </div>
        </form>

        <script>
          var validator = new Validator("resetPassword");
          validator.addValidation("pass", "req", "Please enter your new password");
          validator.addValidation("pass", "minlen=6", "Password minimum length is 6!");
          validator.addValidation("confirm-pass", "req", "Please retype your new password");
          validator.addValidation("confirm-pass", "eqelmnt=pass",
            "The confirmed password is not the same as password");

        </script>
      </div>

    </div>
  </div>
</div>


</body>
</html>