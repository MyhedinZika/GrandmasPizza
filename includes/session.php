<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
date_default_timezone_set('UTC');
include("dbconnect.php");


class Session
{
  public $username;     //Username given on sign-up
  public $time;         //Time user was last active (page loaded)
  public $logged_in;    //True if user is logged in, false otherwise
  public $userinfo = array();  //The array holding all user info
  public $message;

  /* Class constructor */
  function __construct()
  {
    $this->time = time();
    $this->startSession();
  }

  function startSession()
  {
    global $database;  //The database connection
    session_start();   //Tell PHP to start the session

    /* Determine if user is logged in */
    $this->logged_in = $this->checkLogin();

  }

  function checkLogin()
  {
    global $database;  //The database connection
    /* Check if user has been remembered */

    /* Username and userid have been set and not guest */
    if (isset($_SESSION['username'])) {

      /* User is logged in, set class variables */
      // $this->userinfo  = $this->getUserInfo($_SESSION['username']);
      // $this->username  = $this->userinfo['username'];
      return true;
    } /* User not logged in */
    else {
      return false;
    }
  }

//	function login($subuser, $subpass)
//	{
////		global $database;
//		$result = $this->confirmUserPass($subuser, $subpass);
//		if($result) { // They entered correct details
//			$this->userinfo  = $this->getUserInfo($subuser);
//			$this->username  = $_SESSION['username'] = $this->userinfo['username'];
//			setcookie("this_login", time(), time()+60*60*24*7300, '/');
//			return true;
//		} else {
//			return false;
//		}
//	}
//
  function logout()
  {
    global $database;  //The database connection
//		setcookie("last_login", $_COOKIE['this_login'], time()+60*60*24*7300, '/');
    /* Unset PHP session variables */
    unset($_SESSION['username']);
    /* Reflect fact that user has logged out */
    $this->logged_in = false;

    /* Destroy session */
    session_destroy();
  }

  /* 	function register($data)
    {
      global $database;
      if(!get_magic_quotes_gpc()){
        $firstname = addslashes($data['name']);
        $lastname = addslashes($data['surname']);
        $username = addslashes($data['username']);
        $password = addslashes($data['password']);
        }
      else {
        $firstname=$data['name'];
        $lastname=$data['surname'];
        $username=$data['username'];
        $password=$data['password'];
      }
        $password = sha1($password);
        $sql = "SELECT * FROM users WHERE username = ? ";
        $stmt = $database->connection->prepare($sql);
      $stmt->execute(array($username));
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
       if(isset($result['username'])) {
           echo "<script type='text/javascript'> window.alert('Username already exists!'); </script>";
          return 0;
         } else{
        $sql = "INSERT INTO users SET name = ?, surname = ?, username = ?, password = ?";
            $stmt = $database->connection->prepare($sql);
        $stmt->execute(array($firstname, $lastname, $username, $password));
        return 1;
         }
    } */
  function getNormalPizza()
  {
    global $database;
    $sql = "SELECT pizza.* FROM pizza, category WHERE category.c_id = 1 AND category.c_id = pizza.category";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $normalPizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $normalPizzas;

  }

  function getIngredients()
  {
    global $database;
    $sql = "SELECT * FROM ingredients";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $ingredientsList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $ingredientsList;

  }

  function getCategory()
  {
    global $database;
    $sql = "SELECT * FROM category";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $categoryList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categoryList;
  }


  function getOneCategory($categoryId)
  {
    global $database;
    $sql = "SELECT * FROM category WHERE c_id = :c_id";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('c_id', $categoryId);
    $stmt->execute();
    $cat = $stmt->fetch();

    return $cat;
  }

  function getOneIngredient($ingredientId)
  {
    global $database;
    $sql = "SELECT * FROM ingredients WHERE i_id = :i_id";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('i_id', $ingredientId);
    $stmt->execute();
    $ing = $stmt->fetch();

    return $ing;
  }

  function updateIngredient($ingredientId, $ingredientName)
  {
    global $database;
    $sql = "UPDATE ingredients SET i_name = :i_name WHERE i_id = :i_id";

    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('i_id', $ingredientId);
      $stmt->bindParam('i_name', $ingredientName);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Ingredient successfully updated!';
  }

  function updateSize($sizeId, $sizeName, $sizeDiameter)
  {
    global $database;
    $sql = "UPDATE size SET name = :name, diameter = :diameter WHERE id = :id";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('id', $sizeId);
      $stmt->bindParam('name', $sizeName);
      $stmt->bindParam('diameter', $sizeDiameter);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Size successfully updated!';
  }

  function updateCategory($categoryId, $categoryName)
  {
    global $database;
    $sql = "UPDATE  category set c_name = :c_name WHERE c_id = :c_id";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('c_id', $categoryId);
      $stmt->bindParam('c_name', $categoryName);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Category successfully updated!';
  }

  function updateSubOrderQuantity($subOrderId, $quantity)
  {
    global $database;
    $sql = "UPDATE order_products SET Quantity = :Quantity where OrderProductsId = :OrderProductsId";
    try {
      if ($quantity > 0) {
        $stmt = $database->connection->prepare($sql);
        $stmt->bindParam('OrderProductsId', $subOrderId);
        $stmt->bindParam('Quantity', $quantity);
        $stmt->execute();
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }

  }

  function updateGallery($galleryId)
  {
    //global $database;
    var_dump($_POST);
    $sql = "UPDATE gallery SET g_title = :g_title, g_description = :g_description, g_photo = :g_photo WHERE g_id = :g_id";

    try {
      $title = $_POST['title'];
      var_dump($_POST);
      $imgFile = $_FILES['new-image']['name'];
      $tmp_dir = $_FILES['new-image']['tmp_name'];
      $imgSize = $_FILES['new-image']['size'];

      $description = $_POST['description'];
      if (empty($title)) {
        $errMSG = "Please Enter Title.";
      } else if (empty($imgFile)) {
        $errMSG = "Please Select Image File.";
      } else {
        $upload_dir = __DIR__ . '\gallery_images\\'; // upload directory

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


      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('g_id', $galleryId);
      $stmt->bindParam('g_title', $title);
      $stmt->bindParam('g_description', $description);
      $stmt->bindParam('g_photo', $image);
      $stmt > execute();


    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Gallery image successfully updated!';

  }

  function getSize($sizeId)
  {
    global $database;
    $sql = "SELECT * FROM size WHERE id = :id";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('id', $sizeId);
    $stmt->execute();
    $size = $stmt->fetch();

    return $size;

  }

  function addCategory($name)
  {
    global $database;
    try {
      $stmt = $database->connection->prepare('INSERT INTO category(c_name) VALUES(:name)');

      $stmt->bindParam(':name', $name);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Category ' . $name . ' created!';
  }


  function addSize($name, $dia)
  {
    global $database;
    try {
      $stmt = $database->connection->prepare('INSERT INTO size(name, diameter) VALUES(:name, :dia)');

      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':dia', $dia);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Size ' . $name . ' created!';
  }

  function addIngredient($name)
  {
    global $database;
    try {
      $stmt = $database->connection->prepare('INSERT INTO ingredients(i_name) VALUES(:name)');

      $stmt->bindParam(':name', $name);

      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Ingredient ' . $name . ' created!';
  }

//Captcha and Login failed functions

  function addLoginAttempts($ip, $counter)
  {
    global $database;

    try {
      $stmt = $database->connection->prepare('INSERT INTO login_attempts(ip, failedCounter) VALUES(:ip, :counter) ');
      $stmt->bindParam(':ip', $ip);
      $stmt->bindParam(':counter', $counter);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

  }

  function getLoginAttempt($ip)
  {
    global $database;
    $sql = "SELECT * FROM login_attempts WHERE ip = :ip";
    try {

      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('ip', $ip);
      $stmt->execute();
      $loginAttempt = $stmt->fetch();

      return $loginAttempt;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  function checkIfIpExists($ip)
  {
    global $database;
    $sql = "SELECT * FROM login_attempts WHERE ip = :ip";
    try {

      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('ip', $ip);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }


    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  function updateIpCounter($ip, $updatedCounter)
  {
    global $database;
    $sql = "UPDATE login_attempts SET failedCounter = :failedCounter WHERE ip = :ip";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('ip', $ip);
      $stmt->bindParam('failedCounter', $updatedCounter);

      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  function deleteIPCounter($ip)
  {
    global $database;
    $sql = "DELETE from login_attempts WHERE ip = :ip";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('ip', $ip);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }


  function getSizes()
  {
    global $database;
    $sql = "SELECT * FROM size";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $sizesList = $stmt->fetchall(PDO::FETCH_ASSOC);

    return $sizesList;
  }

  function getNormalPizzaPrice()
  {
    global $database;
    $sql = "Select DISTINCT(price) from pizza inner join pizza_size inner join category where c_name = 'Normal Pizza'";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $normalPizzasPrice = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $normalPizzasPrice;
  }

  function getPizzasForCategory($categoryId)
  {
    global $database;
    $sql = "Select * from pizza where Category = :category_id";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('category_id', $categoryId);
    $stmt->execute();
    $pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $pizzas;
  }

  function getDailyOffers()
  {
    global $database;
    $sql = "SELECT * FROM dailyoffer, pizza, size, drinks WHERE pizza.p_id = dailyoffer.PizzaFK AND size.id = dailyoffer.SizeFK AND drinks.D_id = dailyoffer.DrinksFK";

    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $dailyOffers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dailyOffers;
  }

  function getDailyOffer($DailyId)
  {
    global $database;
    $sql = "Select * from dailyoffer WHERE DailyId = :DailyId";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('DailyId', $DailyId);
    $stmt->execute();
    $dailyOffer = $stmt->fetch();

    return $dailyOffer;
  }

  function deleteDailyOffer($DailyId)
  {
    global $database;
    $sql = "DELETE from dailyoffer WHERE DailyId = :DailyId";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('DailyId', $DailyId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Daily Offer successfully deleted!';
  }

  function getDrinks()
  {
    global $database;
    $sql = "Select * from drinks";

    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $drinks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $drinks;
  }

  function getPizzas()
  {
    global $database;
    $sql = "Select * from pizza";

    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $pizzas;
  }

  function getPizza($pizzaId)
  {
    global $database;
    $sql = "Select * from pizza WHERE p_id = :p_id";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('p_id', $pizzaId);
    $stmt->execute();
    $pizza = $stmt->fetch();

    return $pizza;
  }

  function getSubOrder($suborderId)
  {
    global $database;
    $sql = "SELECT * from order_products where OrderProductsId = :orderproductId";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('orderproductId', $suborderId);
    $stmt->execute();
    $suborder = $stmt->fetch();

    return $suborder;
  }


  function getUser($userId)
  {
    global $database;
    $sql = "Select * from users WHERE userID = :userID";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('userID', $userId);
    $stmt->execute();
    $user = $stmt->fetch();

    return $user;
  }

  function getAddress($addressId)
  {
    global $database;
    $sql = "Select * from address where Address_Id= :address_id";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('address_id', $addressId);
    $stmt->execute();
    $address = $stmt->fetch();

    return $address;
  }

  function getUserAddresses($userId)
  {
    global $database;
    $sql = "SELECT DISTINCT orders.address_id, address.address_1, address.address_2,address.city, address.postal_code FROM orders, address where orders.address_Id = address.address_id AND User_Id = :User_Id";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('User_Id', $userId);
    $stmt->execute();
    $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $addresses;

  }

  function deleteUser($userId)
  {
    global $database;
    $sql = "DELETE from users WHERE userID = :userId";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('userId', $userId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'User successfully deleted!';
  }

  function deletePizza($pizzaId)
  {
    global $database;
    $sql = "DELETE from pizza WHERE p_id = :p_id";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('p_id', $pizzaId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Pizza successfully deleted!';
  }

  function deleteSubOrder($subOrderId)
  {
    global $database;
    $sql = "DELETE from order_products WHERE OrderProductsId = :OrderProductsId";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('OrderProductsId', $subOrderId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return "Your product has been succesfully deleted.";

  }

  function deleteSize($sizeId)
  {
    global $database;
    $sql = "DELETE from size WHERE id = :id";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('id', $sizeId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Size successfully deleted!';
  }


  function deleteCategory($categoryId)
  {
    global $database;
    $sql = "DELETE from category WHERE c_id = :c_id";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('c_id', $categoryId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Category successfully deleted!';
  }

  function deleteIngredient($ingredientId)
  {
    global $database;
    $sql = "DELETE from ingredients WHERE i_id = :i_id";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('i_id', $ingredientId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Ingredient successfully deleted!';
  }

  function getPizzaPrices($pizzaId)
  {
    global $database;
    $sql = "SELECT DISTINCT id,(size.name), pizza_size.price FROM size, pizza, pizza_size WHERE pizza_size.pizza = :pizza_id AND size.id = pizza_size.size";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('pizza_id', $pizzaId);
    $stmt->execute();
    $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $sizes;
  }

  function getPizzaIngredients($pizzaId)
  {
    global $database;
    $sql = "SELECT i_id,ingredients.i_name FROM pizza, ingredients, pizza_ingredient WHERE pizza_ingredient.pizza = pizza.p_id AND pizza.p_id = :pizza_id AND pizza_ingredient.ingredient = ingredients.i_id";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('pizza_id', $pizzaId);
    $stmt->execute();
    $i = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $i;
  }

  function getGalleries()
  {
    global $database;
    $sql = "Select * from gallery";

    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $gallery;
  }

  function getGallery($galleryId)
  {
    global $database;
    $sql = "Select * from gallery WHERE g_id = :g_id";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('g_id', $galleryId);
    $stmt->execute();
    $gallery = $stmt->fetch();

    return $gallery;
  }

  function deleteGallery($galleryId)
  {
    global $database;
    $sql = "DELETE from gallery WHERE g_id = :g_id";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('g_id', $galleryId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }

    return 'Gallery successfully deleted!';
  }

  function getOrders($condition)
  {
    global $database;
    $sql = "SELECT * from orders WHERE Status = 'Completed'" . $condition;
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders;

  }

  function getOrderProducts($orderId)
  {
    global $database;
    $sql = "SELECT * FROM order_products where Order_IdFK = :Order_IdFK";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('Order_IdFK', $orderId);
    $stmt->execute();
    $orderProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orderProducts;


  }

  function createCart($userId)
  {
    global $database;

    $stmt = $database->connection->prepare('INSERT INTO orders(Total, Status, User_Id) VALUES(0, "In_Progress", :userId)');

    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
  }

  function getOrderId($userId)
  {
    global $database;
    $sql = "SELECT * from orders where Status = 'In_Progress' AND User_Id = :User_Id";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('User_Id', $userId);
    $stmt->execute();
    $orderId = $stmt->fetch();
    return $orderId;
  }

  function getOrderbyId($orderId)
  {
    global $database;
    $sql = "SELECT * from orders where Order_Id = :order_id";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('order_id', $orderId);
    $stmt->execute();
    $orderId = $stmt->fetch();
    return $orderId;
  }

  function updateOrderStatus($Order_Id)
  {
    global $database;

    $sql = "UPDATE orders SET Status = 'Pending' WHERE Order_Id = :order_id";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('order_id', $orderId);
    $stmt->execute();

  }

  function updateOrderToAccepted($Order_Id)
  {
    global $database;

    $sql = "UPDATE orders SET Status = 'Accepted' WHERE Order_Id = :order_id";

    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('order_id', $orderId);
    $stmt->execute();
  }

  function checkOrderPrice($orderId, $total)
  {
    global $database;
    $sql = "SELECT * from orders where Order_Id = :order_id AND Total = :total";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('order_id', $orderId);
    $stmt->bindParam('total', $total);
    $stmt->execute();
    $checkOrderPrice = $stmt->fetch();
    return $checkOrderPrice;

  }

  function getPendingOrders()
  {
    global $database;
    $sql = "SELECT * from orders where Status = 'Pending'";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $pendingOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $pendingOrders;
  }

  function getAcceptedOrders()
  {
    global $database;
    $sql = "SELECT * from orders where Status = 'Accepted'";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $acceptedOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $acceptedOrders;
  }

  function getCompletedOrders()
  {
    global $database;
    $sql = "SELECT * from orders where Status = 'Completed'";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $completedOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $completedOrders;
  }

  function getCanceledOrders()
  {
    global $database;
    $sql = "SELECT * from orders where Status = 'Canceled'";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $canceledOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $canceledOrders;
  }


  function getPizzaProduct($orderId)
  {
    global $database;
    $sql = "SELECT * FROM order_products RIGHT JOIN pizza on order_products.Pizza_IdFK=pizza.p_id WHERE  Order_IdFK = :Order_IdFK";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('Order_IdFK', $orderId);
    $stmt->execute();
    $pizzaProduct = $stmt->fetch();

    return $pizzaProduct;
  }

  function addPizzaToOrder($orderId, $sizeFk, $pizzaFk, $quantity)
  {
    global $database;
    if ($quantity > 0) {
      $stmt = $database->connection->prepare('INSERT INTO order_products(Order_IdFK, Size, Pizza_IdFK, Quantity) VALUES(:orderId, :sizeFk, :pizzaFk, :quantity)');

      $stmt->bindParam(':orderId', $orderId);
      $stmt->bindParam(':sizeFk', $sizeFk);
      $stmt->bindParam(':pizzaFk', $pizzaFk);
      $stmt->bindParam(':quantity', $quantity);
      $stmt->execute();
    }
  }

  function addDailyDealToOrder($orderId, $dealFk, $quantity)
  {
    global $database;
    if ($quantity > 0) {
      $stmt = $database->connection->prepare('INSERT INTO order_products(Order_IdFK, DailyIdFK, Quantity) VALUES(:orderId, :dealFk, :quantity)');

      $stmt->bindParam(':orderId', $orderId);
      $stmt->bindParam(':dealFk', $dealFk);
      $stmt->bindParam(':quantity', $quantity);
      $stmt->execute();
    }
  }

  function createAddress($address_1, $address_2, $city, $postalcode)
  {
    global $database;

    $stmt = $database->connection->prepare('INSERT INTO address(Address_1, Address_2, City, Postal_Code) VALUES(:address_1,:address_2,:city,:postal_code)');

    $stmt->bindParam(':address_1', $address_1);
    $stmt->bindParam(':address_2', $address_2);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':postal_code', $postalcode);

    $stmt->execute();
  }

  function getDailyOfferProducts($orderId)
  {
    global $database;
    $sql = " SELECT * FROM order_products RIGHT JOIN dailyoffer on order_products.DailyIdFK=dailyoffer.DailyId WHERE  Order_IdFK = :Order_IdFK";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('Order_IdFK', $orderId);
    $stmt->execute();
    $dailyOfferProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dailyOfferProducts;


  }

  function getProductPrice($pizzaId, $sizeId)
  {
    global $database;
    $sql = "SELECT * from pizza_size where pizza = :pizza AND size = :size";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('pizza', $pizzaId);
    $stmt->bindParam('size', $sizeId);
    $stmt->execute();
    $productPrice = $stmt->fetch();
    return $productPrice;
  }

  function checkUserAddress($Address_1, $Address_2, $City, $Postal_Code)
  {
    global $database;
    $sql = "SELECT * from address where Address_1 = :address_1 AND Address_2 = :address_2 AND City = :city AND Postal_Code = :postal_code";
    $stmt = $database->connection->prepare($sql);
    $stmt->bindParam('address_1', $Address_1);
    $stmt->bindParam('address_2', $Address_2);
    $stmt->bindParam('city', $City);
    $stmt->bindParam('postal_code', $Postal_Code);
    $stmt->execute();
    $userAddress = $stmt->fetch();
    return $userAddress;

  }

  function updateOrderAddressPrice($addressId, $orderId, $total)
  {
    global $database;
    $sql = "UPDATE orders SET Address_Id = :address_id, Total = :total  WHERE Order_Id = :order_id";
    try {
      $stmt = $database->connection->prepare($sql);
      $stmt->bindParam('address_id', $addressId);
      $stmt->bindParam('total', $total);
      $stmt->bindParam('order_id', $orderId);
      $stmt->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }


  }


  function confirmUserPass($username, $password)
  {
    global $database;
    if (!get_magic_quotes_gpc()) {
      $username = addslashes($username);
    }
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $database->connection->prepare($query);
    $stmt->execute(array($username));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $password = stripslashes($password);
    $sqlpass = sha1($password);

    if ($sqlpass == $result['password']) {
      return true;
    } else {
      return false;
    }
  }

  function getUsers()
  {
    global $database;
    $sql = "Select * from users";

    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $pizzas;
  }

  // function getUserInfo($username){
  // 	global $database;
  // 	$sql = "SELECT * FROM users WHERE username = ?";
  // 	$stmt = $database->connection->prepare($sql);
  // 	$stmt->execute(array($username));
  // 	$dbarray = $stmt->fetch(PDO::FETCH_ASSOC);
  // 	/* Error occurred, return given name by default */
  // 	$result = count($dbarray);
  // 	if(!$dbarray || $result < 1){
  // 		return NULL;
  // 	}
  // 	/* Return result array */
  // 	return $dbarray;
  // }
  function getUserPosts()
  {
    global $database;
    $sql = "SELECT * from Postimet";
    $stmt = $database->connection->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchall(PDO::FETCH_ASSOC);

    return $posts;
  }

  function setMessage($message)
  {
    $_SESSION['message'] = $message;
  }

  function getMessage()
  {
    if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
      unset($_SESSION['message']);
      return $message;
    } else {
      return false;
    }
  }
}

$session = new Session();
?>