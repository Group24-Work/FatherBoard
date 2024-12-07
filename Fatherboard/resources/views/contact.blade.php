<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FatherBoard - Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel = "stylesheet" type="text/css" href="Contact.css" /> <!-- Link for Login page stylesheet -->
    <link rel = "stylesheet" type="text/css" href="AboutUsStyle.css"/> <!-- Link for the header styles -->
    <script src="Contact.js" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script> <!--Scripts needed for jQuery-->
   </head>

   <body>
      <!-- Header Section (unchanged, linked to stylesheet.css) -->
<header class="main-header">
    <div class="container">
        <a href="Home.html">
        <img src="FatherboardTransparentCrop.png" id="logo" alt="FatherBoard Logo" width="100" height="50"></a>
        <form class="SearchBar">
            <input type="text" placeholder="Search.." name="search">
        </form>
        <nav class="main-nav">
            <ul class="main-nav-list">
                <li><a href="About.html">About Us</a></li>
                <li><a href="Login.html">Account</a></li>
                <li><a href="basket.html">Basket</a></li>
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
<main>
    <div class="contents">
    <div class="contact-form">
        <h2>Contact us</h2>
        <p>Have an issue or a query? Send us a message!</p>
        <form id="contactForm" name="contactForm">
                <div class="row" id="names">
                    <label for="firstName"></label>
                    <input type="text" placeholder="First Name" name="firstName" id="firstName" required>
                    <label for="lastName"></label>
                    <input type="text" placeholder="Last Name"  name="lastName" id="lastName" required>
                </div>
                <div class="row">
                        <label for="emailAddress"></label>
                        <input type="text" placeholder="Email Address"  name="emailAddress" id="emailAddress" required>
                        <!-- ADD CODE HERE -->
                </div>
                <div class="row">
                    <label for="query"></label>
                    <textarea name="query" placeholder="Enter your query or issue here, and an admin will reply as quick as possible!"  name="query" id="query"></textarea>
                </div>
                <button type="submit">Submit</button>
                </form>
                </div>
            </div>

</main>
  </body>
  </html>