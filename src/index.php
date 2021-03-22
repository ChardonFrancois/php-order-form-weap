<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();



function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//validate form
$emailErr = $streetErr = $streetNumberErr = $cityErr = $zipcodeErr = '';
$email = $street = $streetNumber = $city = $zipcode = '' ;



$confirmed = " ";
$refus = " ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email'])) {
      $emailErr = "E-mail is required";
    } else {
      $email= input($_POST['email']);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }
    if (empty($_POST['street'])) {
        $streetErr = "Street is required";
      } else {
        $street= input($_POST['street']);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$street)) {
            $streetErr = "Only letters and white space allowed";
          }
      }
    if (empty($_POST['streetnumber'])) {
        $streetNumberErr = "Street number is required";
      } else {
        $streetNumber= input($_POST['streetnumber']);
        if(!ctype_digit($streetNumber)){
            $streetNumberErr = 'only number allowed';
        }

      }
    if (empty($_POST['city'])) {
        $cityErr = "City number is required";
      } else {
        $city= input($_POST['city']);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$city)) {
            $cityErr = "Only letters and white space allowed";
          }
      }
      if (empty($_POST['zipcode'])) {
        $zipcodeErr = " Zipcode is required";
      } else {
        $zipcode= input($_POST['zipcode']);
        if(!ctype_digit($zipcode)){
            $zipcodeErr = 'only number allowed';
        }
      }
      if(!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($_POST['email']) ){
          $refus = "votre commande n'a pas été validée";
          
          
        }elseif(!preg_match("/^[a-zA-Z-' ]*$/",$street) || empty($_POST['street'])){
            $refus = "votre commande n'a pas été validée";
            
        }elseif(!ctype_digit($streetNumber)){
            $refus = "votre commande n'a pas été validée";
        }elseif(!preg_match("/^[a-zA-Z-' ]*$/",$city) || empty($_POST['city'])){
            $refus = "votre commande n'a pas été validée";
        }elseif(!ctype_digit($zipcode)){
            $refus = "votre commande n'a pas été validée";
        }elseif(!isset($_POST['products'])){
          $refus = "Command not found";
        }
        
        else{
            $confirmed = 'commande confirmed an email has been sent to you.';
            
            
        }
    }
        
       $_SESSION['email'] = $email;
       $_SESSION['street'] = $street;
       $_SESSION['streetnumber'] = $streetNumber;
       $_SESSION['city'] = $city;
       $_SESSION['zipcode'] = $zipcode;

            
        
            
   

        
       
        
  

       function input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }





  
  
  
  
  //your products with their price.
  $pizza = [
      ['name' => 'Margherita', 'price' => 8],
      ['name' => 'Hawaï', 'price' => 8.5],
      ['name' => 'Salami pepper', 'price' => 10],
      ['name' => 'Prosciutto', 'price' => 9],
      ['name' => 'Parmiggiana', 'price' => 9],
      ['name' => 'Vegetarian', 'price' => 8.5],
      ['name' => 'Four cheeses', 'price' => 10],
      ['name' => 'Four seasons', 'price' => 10.5],
      ['name' => 'Scampi', 'price' => 11.5]
    ];
    
    $drink = [
        ['name' => 'Water', 'price' => 1.8],
        ['name' => 'Sparkling water', 'price' => 1.8],
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 2.2],
    ];
    
    $totalValue = 0;
    
    //switch de page 
    $products = $pizza;
    if(isset($_GET['food'])){
        if($_GET['food'] == false){
            $products = $drink;
        }
    }
    
    //calcul price
    
    if(isset($_POST['products'])){
        foreach($_POST['products'] as $i => $product){
            $totalValue += $products[$i]['price'];
        }
       
    }
    if(isset($_POST['express_delivery'])){
        $totalValue += $_POST['express_delivery'];
    }

    // vive les tcheat code ! &nbsp; 
    if(isset( $_POST['express_delivery']) && !empty($_POST['email']) && !empty($_POST['street']) && !empty($_POST['streetnumber']) && !empty($_POST['city']) && !empty($_POST['zipcode']) && isset($_POST['products']) ){
      $delivery = " </br>   &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; " ."------- delivery: 30 min -------" ;
    } elseif(isset($_POST['products']) && !empty($_POST['email']) && !empty($_POST['street']) && !empty($_POST['streetnumber']) && !empty($_POST['city']) && !empty($_POST['zipcode'])){
      $delivery = " </br>   &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; " . "------- delivery: 1 hour -------" ;
    } else{
      $delivery = ' ';
    }




    require 'form-view.php';