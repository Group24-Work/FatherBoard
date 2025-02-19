<head> 
    <meta charset="utf-8" />
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel = "stylesheet" type="text/css" href=<?php echo e(asset("css/stylesheet.css")); ?> /><!-- Link for header  stylesheet -->
    <link rel = "stylesheet" type="text/css" href=<?php echo e(asset("css/logincss.css")); ?> /><!-- Link for the login styles -->
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
    <!-- Login page form -->
    <header id = "header1">
        <h1>Login</h1>
        <p>New user? <a href="Signup.html"><p>Create a new account!</p></a></p>
        <form id = "login">
            <br> <input type = "email" id ="mail" placeholder="Email" required/> </br>
            <br> <input type="password" id ="pass" placeholder="Password" required /> </br>
            <div id="pass2">
            <a href="code if user forget password">Forgot password?</a> <!-- ADD CODE HERE -->
            </div id="pass2">
            <br> <input type="submit" id ="lgnbtn" value="LOGIN" /> </br>
      </form>
      </header>
   </body><?php /**PATH C:\Users\Elliot\Documents\Coding\FatherBoard\Fatherboard\resources\views/login.blade.php ENDPATH**/ ?>