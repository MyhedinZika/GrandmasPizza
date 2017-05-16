<?php
    include('../includes/class.session.php');

    $user=new SESSION();

    if(isset($_POST) !== null){
        if(isset($_POST['submit']) && $_POST['submit'] === 'sendMessage' ){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $user->sendFeedback($name,$email,$subject,$message);  
    }
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Restaurant</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css" media="screen" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style-portfolio.css">
        <link rel="stylesheet" href="css/picto-foundry-food.css" />
        <link rel="stylesheet" href="css/jquery-ui.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link rel="icon" href="favicon-1.ico" type="image/x-icon">

        <style>
         #test li{
            color: red important;
         }
        </style>
    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">iMenu</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
               
                        <ul class="nav navbar-nav main-nav  clear navbar-right ">
                            <li><a class="color_animation" href="#pricing">Pricing</a></li>
                            <li><a class="color_animation" href="#reservation">Reservation</a></li>
                            <li><a class="color_animation" href="#contact">Contact</a></li>
                            <li><a class="color_animation" href="../pages/login.php">Log in / Sign up</a></li>
                        </ul>
                    
               
                </div>
            </div><!-- /.container-fluid -->
        </nav>
    
         
     

        <!-- ============ About Us ============= -->



         <section id ="pricing" class="description_content">
             <div class="pricing background_content">
                <h1><a href="#opa">Order Here</a></br><span class="error_number">&dArr;</span></h1>
              

             </div>
           
           
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-restaurant-menu-area">
          <div class="mu-title">
            <span class="mu-subtitle">Discover</span>
            <h2>OUR MENU</h2>
            <i class="fa fa-spoon"></i>
            <span class="mu-title-bar"></span>
          </div>
       
          <div class="mu-restaurant-menu-content">
            <ul class="nav nav-tabs mu-restaurant-menu">
              <?php
              $categories = $user->getCategories();
              $isActive = ' class="active" ';
              foreach ($categories as $key => $value) {
                echo '<li' . $isActive . '><a href="#category-' . $value['categoryId'] . '" data-toggle="tab">' . $value['name'] . '</a></li>';
                $isActive = '';
              }
              ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <?php foreach ($categories as $key => $value): ?>
              <div class="tab-pane fade in <?= $key == 0 ? 'active' : '' ?>" id="category-<?= $value['c_id'] ?>">
                <div class="mu-tab-content-area">
                  <div class="row">
                  <?php  
                                $pizzas = $user->getProductsByCategory($value['categoryId']);
                                foreach ($pizzas as $key => $value) {
                                  $pizzaId = $value['productId'];
                                  ?>
                                  <div class="col-md-6">
                                    <div class="mu-tab-content-left">
                                      <ul class="mu-menu-item-nav">
                                        <li>
                                          <div class="media">
                                            <div class="media-left">
                                              <a href="#">
                                                <?php
                                                echo '<img class="media-object" src="../includes/product_images/' . $value['photo'] . '"" alt="img">';
                                                ?>
                                              </a>
                                            </div>
                                            <div class="media-body">
                                              <h4 class="media-heading"><a href="#"><?php echo $value['name']; ?></a>
                                              </h4>
                                              <?php

                                              // echo $pizzaId;
                                              if ($user->is_logged_in()) {
                                                $prices = $user->getPizzaPrices($pizzaId);
                                                foreach ($prices as $key => $value) {
                                                  echo $value['name'] . ' <span class="mu-menu-price currency" data-pizza-id="' . $pizzaId . '" data-pizza-price="' . $value['price'] . '">$' . $value['price'] . '</span>';
                                                }
                                              } else {
                                                echo '<h6 style=color:red>Prices are visible for logged in users!</h6>';
                                              }

                                              $ingredientsRaw = $user->getPizzaIngredients($pizzaId);

                                              $ingredients = [];
                                              foreach ($ingredientsRaw as $ingredient) {
                                                array_push($ingredients, $ingredient['i_name']);
                                              }

                                              $ingredientsFormatted = join(' | ', $ingredients); // this will concatenate each ingredient to A | B | C

                                              ?>
                                              <p></p>
                                              <p><?php echo $ingredientsFormatted; ?>.</p>
                                            </div>
                                          </div>

                                          <div class="basket-options">
                                            <form action="#" method="post">
                                              <div class="input-stepper">
                                                <button type="button" data-input-stepper-decrease>-</button>
                                                <input type="text" name="qty-<?= $pizzaId ?>" id="qty-<?= $pizzaId ?>"
                                                       value="1">
                                                <button type="button" data-input-stepper-increase>+</button>
                                              </div>

                                              <?php

                                              $prices = $user->getPizzaPrices($pizzaId);
                                              ?>
                                              <select name="pizza-size-<?= $pizzaId ?>" id="pizza-size-<?= $pizzaId ?>">
                                                <?php
                                                foreach ($prices as $key => $value) {
                                                  echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';

                                                }
                                                ?>
                                                <select>
                                                  <?php if ($user->is_logged_in()) { ?>
                                                    <button type="submit" class="add-to-basket"
                                                            onclick="addToCart(event, $('#pizza-size-<?= $pizzaId ?>').val(), $('#qty-<?= $pizzaId ?>').val(), <?= $pizzaId ?>)">
                                                      Add to cart
                                                    </button>
                                                  <?php } ?>
                                            </form>
                                          </div>

                                        </li>

                                      </ul>
                                    </div>
                                  </div>
                                <?php }
                              ?>
                            </div>
                      </div>
                    </div>
                    <?php endforeach; // category ?>
                 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</section>


        <!-- ============ Our Beer  ============= -->




       <!-- ============ Our Bread  ============= -->



        
        <!-- ============ Featured Dish  ============= -->



        <!-- ============ Reservation  ============= -->

        <section  id="reservation"  class="description_content">

            <div class="text-content container"> 
                <div class="inner contact">
                    <!-- Form Area -->
                    <div class="contact-form">
                        <!-- Form -->
                        <form id="contact-us" method="post" action="reserve.php">
                            <!-- Left Inputs -->
                            <div class="container">
                                <div class="reservation"> Reservation</div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-6 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-6">
                                                <!-- Name -->
                                                <input type="text" name="first_name" id="first_name" required="required" class="form" placeholder="First Name" />
                                                <input type="text" name="last_name" id="last_name" required="required" class="form" placeholder="Last Name" />
                                                <input type="text" name="state" id="state" required="required" class="form" placeholder="State" />
                                                <input type="text" name="datepicker" id="datepicker" required="required" class="form" placeholder="Reservation Date" />
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-xs-6">
                                                <!-- Name -->
                                                <input type="text" name="phone" id="phone" required="required" class="form" placeholder="Phone" />
                                                <input type="text" name="guest" id="guest" required="required" class="form" placeholder="Guest Number" />
                                                <input type="email" name="email" id="email" required="required" class="form" placeholder="Email" />
                                                <input type="text" name="subject" id="subject" required="required" class="form" placeholder="Subject" />
                                            </div><br>

                                            <div class="col-xs-6 ">
                                                <!-- Send Button -->
                                                <button type="submit" id="submit" name="submit" class="text-center form-btn form-btn">Reserve</button> 
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <!-- Message -->
                                        <div class="right-text">
                                            <h2>Hours</h2><hr>
                                            <p>Monday to Friday: 7:30 AM - 11:30 AM</p>
                                            <p>Saturday & Sunday: 8:00 AM - 9:00 AM</p>
                                            <p>Monday to Friday: 12:00 PM - 5:00 PM</p>
                                            <p>Monday to Saturday: 6:00 PM - 1:00 AM</p>
                                            <p>Sunday to Monday: 5:30 PM - 12:00 AM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Clear -->
                            <div class="clear"></div>
                        </form>
                    </div><!-- End Contact Form Area -->
                </div><!-- End Inner -->
            </div>
        </section>

        <!-- ============ Social Section  ============= -->


        <!-- ============ Contact Section  ============= -->

        <section id="contact">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="inner contact">
                            <div class="contact-us"> Contact Us </div>
                            <!-- Form Area -->
                            <div class="contact-form">
                                <!-- Form -->
                                <form id="contact-us" method="POST" >
                                    <!-- Left Inputs -->
                                    <div class="col-md-6 ">
                                        <!-- Name -->
                                        <input type="text" name="name" id="name" required="required" class="form" placeholder="Name" />
                                        <!-- Email -->
                                        <input type="email" name="email" id="email" required="required" class="form" placeholder="Email" />
                                        <!-- Subject -->
                                        <input type="text" name="subject" id="subject" required="required" class="form" placeholder="Subject" />
                                    </div><!-- End Left Inputs -->
                                    <!-- Right Inputs -->
                                    <div class="col-md-6">
                                        <!-- Message -->
                                        <textarea name="message" id="message" class="form textarea"  placeholder="Message"></textarea>
                                    </div><!-- End Right Inputs -->
                                    <!-- Bottom Submit -->
                                    <div class="relative fullwidth col-xs-12">
                                        <!-- Send Button -->
                                        <button type="submit" id="submit" name="submit" value="sendMessage" class="form-btn">Send Message</button> 
                                    </div><!-- End Bottom Submit -->
                                    <!-- Clear -->
                                    <div class="clear"></div>
                                </form>
                            </div><!-- End Contact Form Area -->
                        </div><!-- End Inner -->
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ Footer Section  ============= -->

        <footer class="sub_footer">
            <div class="container">
               <!-- <div class="col-md-4"><p class="sub-footer-text text-center">&copy; Restaurant 2014, Theme by <a href="https://themewagon.com/">ThemeWagon</a></p></div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Back to <a href="#pricing">TOP</a></p>
                </div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Built With Care By <a href="#" target="_blank">Us</a></p></div> -->
            </div>
        </footer>


        <!-- <script type="text/javascript" src="js/jquery-1.10.2.min.js"> </script> -->
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>     
        <script type="text/javascript" src="js/jquery.mixitup.min.js" ></script>
        <script type="text/javascript" src="js/main.js" ></script>
        <script type="text/javascript" src="js/bootstrap.min.js" ></script>




    </body>
</html>