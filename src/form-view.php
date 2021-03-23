<?php
$cookie_name = 'user';
$cookie_value = '
customer';
setcookie($cookie_name, $cookie_value, time() + 86400 );

// if(!isset($_COOKIE[$cookie_name])) {
//     echo "Cookie named '" . $cookie_name . "' is not set!";
//   } else {
//     echo "Cookie '" . $cookie_name . "' is set!<br>";
//     echo "Value is: " . $_COOKIE[$cookie_name];
//   }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ranchers&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Unicase:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Della+Respira&display=swap" rel="stylesheet">
    
    <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/001/200/979/original/pizza-png.png">
    <link rel="stylesheet" href="./style.css">
    <title>Order Pizzas & drinks</title>
</head>
<body>


<div class="container ">
    <div class="police-head">
    <h1 class="d-flex justify-content-center">Order pizzas in restaurant "the Personal Pizza Processors"</h1>
    <nav>
        <ul class="nav d-flex justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order pizzas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
</div>
    <p class="text-white bg-success d-flex justify-content-center rounded-pill "><?php echo $confirmed . $delivery ?> 
    </p>
    <p class="text-white bg-danger d-flex justify-content-center rounded-pill " ><?php echo $refus;?></p>
    <p class=" d-inline required ">* <span>required field</span></p>
    <form class="police2" method="post" method="index.php" id="form">
        <div class="form-row ">
            <div class="form-group col-md-6">
                <label class="label" for="email">E-mail:</label>
                <span class="error text-danger" >* <?php echo $emailErr;?></span>
                <input type="text" id="email" name="email" class="form-control input" value = "<?php echo $email;?>" placeholder= "iLovePizza@outlook.be" />
            </div>
            <div></div>
        </div>

        <fieldset >
            <legend class="d-flex  title">Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="label" for="street">Street:</label>
                    <span class="error text-danger">* <?php echo $streetErr;?></span>
                    <input type="text" name="street" id="street" class="form-control input" value= "<?php echo $street;?>" placeholder="Place de la gare " >
                </div>
                <div class="form-group col-md-6">
                    <label class=" label" for="streetnumber">Street number:</label>
                    <span class="error text-danger">* <?php echo $streetNumberErr;?></span>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control input" value= "<?php echo $streetNumber;?>" placeholder= " 54 " >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class=" label" for="city">City:</label>
                    <span class="error text-danger">* <?php echo $cityErr;?></span>
                    <input type="text" id="city" name="city" class="form-control input" value= "<?php echo $city;?>" placeholder="Marche-En-Famene" >
                </div>
                <div class="form-group col-md-6">
                    <label class="label" for="zipcode">Zipcode</label>
                    <span class="error text-danger">* <?php echo $zipcodeErr;?></span>
                    <input type="text" id="zipcode" name="zipcode" class="form-control input" value= "<?php echo $zipcode;?>" placeholder="6900">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend class="title">Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label class="police">
                    <input type="checkbox" min="0" max="100" value="0" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2)?></label><br />
            <?php endforeach; ?>

        </fieldset>
        
        
        <label class="police">
            <input type="checkbox" name="express_delivery" value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>
        <div class="ma-div">
            <button type="submit" class="btn btn-success btn-submit">Order!</button>
        </div>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in pizza(s) and drinks.</footer>
</div>

</body>
</html>
