<?php
include("session.php");
ini_set("display_errors", "1");
error_reporting(E_ALL);

class Process
{
  /* Class constructor */
  function __construct()
  {
    global $session;
    /* User submitted login form */
    switch ($_POST['action']) {
      case 'login':
        $this->procLogin();
        break;
      case 'register':
        $this->procRegister();
        break;
      case 'sendMessage':
        $this->procAddContact();
        break;
      case 'addPost':
        $this->procAddPost();
        break;
      case 'addPizza':
        $this->procAddPizza();
        header("refresh:1;../admin/list-pizzas.php");
        break;
      case 'addGallery':
        $this->procAddGallery();
        header("refresh:1; ../admin/add-gallery-image.php");
        break;
      case 'addDailyOffer':
        $this->procAddDailyOffer();
        header("refresh:1;../admin/list-dailyoffers.php");
        break;
      case 'addIngredient':
        $this->procAddIngredient();
        header("refresh:1;../admin/list-ingredients.php");
        break;

      default:
        $this->procLogout();
    }


  }

  function procLogin()
  {
    global $session, $form;
    /* Login attempt */
    $retval = $session->login($_POST['username'], $_POST['password']);

    /* Login successful */
//		if($retval){
//			header("Location: ../index.php");
//		} else{  /* Login failed */
//			header("Location: ../index.php");
//		}
  }

  function procRegister()
  {
    global $database, $session;
    $retval = $session->register($_POST);
//		if($retval) {
//			header("Location: ../index.php");
//		} else {
//			header("Location: ../signup.php");
//		}
  }

  function procLogout()
  {
    global $database, $session;
    $retval = $session->logout();
//		header("Location: ../index.php");
  }


  function procAddContact()
  {
    global $database, $session;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $stmt = $database->connection->prepare('INSERT INTO contact(C_name,C_Email,C_Subject,C_Message) VALUES(:name, :email, :subject, :message)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);

    $stmt->execute();

    $message = <<<EMAIL
Hi! My name is $name.

My message is: $message

From: $name
Email: $email

EMAIL;

    $to = 'contactgrandmaspizza@gmail.com';
    //$to='grandmaspizza@hotmail.com';
    $headers = 'From: mail@grandmaspizza.online-presence.com' . "\r\n" .
      // 'Reply-To: mail@grandmaspizza.online-presence.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
    //$headers = '';
    // $headers = 'From: '. $email . "\r\n";


    mail($to, $subject, $message, $headers);


    header("Location: ../index.php");
  }

  function procAddIngredient()
  {
    global $database;

    $ingredientName = $_POST['ingredient-name'];
    $stmt = $database->connection->prepare('INSERT INTO ingredients(i_name) VALUES(:name)');

    $stmt->bindParam(':name', $ingredientName);
    $stmt->execute();

  }

  function procAddDailyOffer()
  {
    global $database;
    $name = $_POST['name']; //Emri i daily offer
    $pizza = $_POST['pizza']; //Pizza
    $size = $_POST['size'];//Madhesia e pizzes
    $drink = $_POST['drink'];//Pija
    $price = $_POST['price-dailyOffer']; //Qmimi i daily offer

    $stmt = $database->connection->prepare('INSERT INTO dailyoffer(DO_Name,DO_Price,PizzaFK,SizeFK, DrinksFK) VALUES(:name, :price, :pizza, :size, :drink)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':pizza', $pizza);
    $stmt->bindParam(':size', $size);
    $stmt->bindParam(':drink', $drink);
    $stmt->bindParam(':price', $price);

    $stmt->execute();

  }

  function procAddPizza()
  {
    global $database;

    $name = $_POST['name'];// name of pizza

    $imgFile = $_FILES['new-image']['name'];
    $tmp_dir = $_FILES['new-image']['tmp_name'];
    $imgSize = $_FILES['new-image']['size'];

    $category = $_POST['category'];
    $ingredients = $_POST['ingredients'];

    $prices = $_POST['price'];

    if (empty($name)) {
      $errMSG = "Please Enter Username.";
    } else if (empty($imgFile)) {
      $errMSG = "Please Select Image File.";
    } else {
      $upload_dir = __DIR__ . '/pizza_images/'; // upload directory 

      $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

      // rename uploading image
      $userpic = rand(1000, 1000000) . "." . $imgExt;

      // allow valid image file formats
      if (in_array($imgExt, $valid_extensions)) {
        // Check file size '5MB'
        if ($imgSize < 5000000) {
          move_uploaded_file($tmp_dir, $upload_dir . $userpic);
        } else {
          $errMSG = "Sorry, your file is too large.";
        }
      } else {
        $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      }
    }


    // insert pizza
    if (!isset($errMSG)) {
      $stmt = $database->connection->prepare('INSERT INTO pizza(p_name,p_photo,Category) VALUES(:name, :photo, :category)');
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':photo', $userpic);
      $stmt->bindParam(':category', $category);


      if (!$stmt->execute()) {
        $errMSG = "error while inserting pizza";
      }
    }

    $pizzaId = $database->connection->lastInsertId();

    // insert ingredients
    if (!isset($errMSG)) {
      foreach ($ingredients as $ingredient) {
        $stmt = $database->connection->prepare('INSERT INTO pizza_ingredient(pizza,ingredient) VALUES(:pizza,:ingredient)');
        $stmt->bindParam(':ingredient', $ingredient);
        $stmt->bindParam(':pizza', $pizzaId);

        if (!$stmt->execute()) {
          $errMSG = "error while inserting into pizza_ingredients";
        }
      }
    }

    //insert prices
    if (!isset($errMSG)) {
      foreach ($prices as $sizeId => $price) {
        $stmt = $database->connection->prepare('INSERT INTO pizza_size(pizza,size,price) VALUES(:pizza, :size, :price)');
        $stmt->bindParam(':pizza', $pizzaId);
        $stmt->bindParam(':size', $sizeId);
        $stmt->bindParam(':price', $price);

        if (!$stmt->execute()) {
          $errMSG = "error while inserting into pizza_size";
        }
      }
    }
  }

  function procAddGallery()
  {
    global $database;

    $title = $_POST['title'];

    $imgFile = $_FILES['new-image']['name'];
    $tmp_dir = $_FILES['new-image']['tmp_name'];
    $imgSize = $_FILES['new-image']['size'];

    $description = $_POST['description'];
    if (empty($title)) {
      $errMSG = "Please Enter Title.";
    } else if (empty($imgFile)) {
      $errMSG = "Please Select Image File.";
    } else {
      $upload_dir = __DIR__ . '/gallery_images/'; // upload directory 

      $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

      // rename uploading image
      $userpic = rand(1000, 1000000) . "." . $imgExt;

      // allow valid image file formats
      if (in_array($imgExt, $valid_extensions)) {
        // Check file size '5MB'
        if ($imgSize < 5000000) {
          move_uploaded_file($tmp_dir, $upload_dir . $userpic);
        } else {
          $errMSG = "Sorry, your file is too large.";
        }
      } else {
        $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      }
    }

    if (!isset($errMSG)) {
      $stmt = $database->connection->prepare('INSERT INTO gallery(g_title,g_description,g_photo) VALUES(:title, :description, :photo)');
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':photo', $userpic);


      if (!$stmt->execute()) {
        $errMSG = "error while inserting gallery";
      }
    }


  }

}

/* Initialize process */
$process = new Process;
?>