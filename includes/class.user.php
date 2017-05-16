<?php

require_once 'dbconfig.php';

class USER
{

  private $conn;

  public function __construct()
  {
    $database = new Database();
    $db = $database->dbConnection();
    $this->conn = $db;
  }

  public function runQuery($sql)
  {
    $stmt = $this->conn->prepare($sql);
    return $stmt;
  }

  public function lasdID()
  {
    $stmt = $this->conn->lastInsertId();
    return $stmt;
  }

  public function register($uname, $surname, $email, $upass, $gender, $phone, $code)
  {
    try {
      $password = password_hash($upass, PASSWORD_DEFAULT);
      $stmt = $this->conn->prepare("INSERT INTO users(userName,userSurname,userEmail,userPassword,userGender,userPhone,tokenCode) 
			                                             VALUES(:user_name,:user_surname, :user_mail, :user_pass,:user_gender,:user_phone, :active_code)");
      $stmt->bindparam(":user_name", $uname);
      $stmt->bindparam(":user_surname", $surname);
      $stmt->bindparam(":user_mail", $email);
      $stmt->bindparam(":user_pass", $password);
      $stmt->bindparam(":user_gender", $gender);
      $stmt->bindparam(":user_phone", $phone);
      $stmt->bindparam(":active_code", $code);
      $stmt->execute();
      return $stmt;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }

  public function login($email, $upass)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
      $stmt->execute(array(":email_id" => $email));
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($stmt->rowCount() == 1) {
        if ($userRow['userStatus'] == 1) {
          if (password_verify($upass, $userRow['userPassword'])) {
            $_SESSION['userSession'] = $userRow['userID'];
            return true;
          } else {
            header("Location: login.php?error");
            exit;
          }
        } else {
          header("Location: login.php?inactive");
          exit;
        }
      } else {
        header("Location: login.php?error");
        exit;
      }
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }

  public function loginAdmin($email, $upass)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
      $stmt->execute(array(":email_id" => $email));
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($stmt->rowCount() == 1) {
        if ($userRow['userStatus'] == 1 && $userRow['userAdmin'] == 1) {
          if (password_verify($upass, $userRow['userPassword'])) {
            $_SESSION['userSession'] = $userRow['userID'];
            return true;
          } else {
            header("Location: login.php?error");
            exit;
          }
        } else {
          header("Location: login.php?inactive");
          exit;
        }
      } else {
        header("Location: login.php?error");
        exit;
      }
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function is_logged_in()
  {
    if (isset($_SESSION['userSession'])) {
      return true;
    }
  }

  public function redirect($url)
  {
    header("Location: $url");
  }

  public function logout()
  {
    session_destroy();
    $_SESSION['userSession'] = false;
  }

  function send_mail($email, $message, $subject)
  {
    require_once('mailer/class.phpmailer.php');
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->AddAddress($email);
    $mail->Username = "contactgrandmaspizza@gmail.com";
    $mail->Password = "shki2016";
    $mail->SetFrom('contactgrandmaspizza@gmail.com', 'Grandmas Pizza');
    $mail->AddReplyTo("contactgrandmaspizza@gmail.com", "Grandmas Pizza");
    $mail->Subject = $subject;
    $mail->MsgHTML($message);
    $mail->Send();
  }
}