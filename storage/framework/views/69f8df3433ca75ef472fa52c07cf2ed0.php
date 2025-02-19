<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Signup Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel = "stylesheet" type="text/css" href=<?php echo e(asset("css/stylesheet.css")); ?> /><!-- Link for header  stylesheet -->
    <link rel = "stylesheet" type="text/css" href=<?php echo e(asset("css/logincss.css")); ?> /> <!-- Link for the header styles -->
</head>

<!-- Header Section (unchanged, linked to stylesheet.css) -->
<header class="main-header">
    <div class="container">
        <a href="home.php"><img src=<?php echo e(asset("images/FatherboardTransparentCrop.png")); ?> id="logo" alt="FatherBoard Logo" width="100" height="50"></a>
        <form class="SearchBar">
            <input type="text" placeholder="Search.." name="search">
        </form>
        <nav class="main-nav">
            <ul class="main-nav-list">
                <li><a href="#register">About Us</a></li>
                <li><a href="#login" class = "active">Account</a></li>
                <li><a href="#products">Basket</a></li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <nav class="lower-nav">
            <ul class="lower-nav-list">
                <li>
                    <a href="#product1">Memory</a>
                    <a href="#product2">CPUs</a>
                    <a href="#product3">Prebuilt Computers</a>
                    <a href="#product4">GPUs</a>
                    <a href="#product5">PSUs</a>
                    <a href="#sale">Sale!!!</a>
                </li>
            </ul>
        </nav>
    </div>
  </header>

<body>

    <!-- Sign up form -->
    <header id = "header2">
        <h1>Create Account</h1>
        <p>Current User? <a href="Login.html"><p>Login!</p></a></p>
        <form id = "signup">
            <br> <input type = "email" id ="mail2" placeholder="Email" required/> </br>
            <br> <input type="text" id="fname" placeholder="First Name" required/> </br>
            <br> <input type="text" id="lname" placeholder="Last Name" required/> </br>
            <br> <input type="password" id ="spass" placeholder="Password" required /> </br>
            <br> <input type="password" id="spass2" placeholder="Confirm Password" required/> </br>
            <br> <input type="checkbox" id="check" required/> <label for="check"> <a href="terms.html">Agree to Terms and Conditions</a></label> </br>
            <br> <input type="submit" id ="sbtn" value="CREATE ACCOUNT" /> </br>
        </form>
    </header>
</body><?php /**PATH C:\Users\Elliot\Documents\Coding\FatherBoard\Fatherboard\resources\views/register.blade.php ENDPATH**/ ?>