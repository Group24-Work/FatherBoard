<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
</head>
<body>
  <div class="wrapper">
    <h1>Forgot Password</h1>
    <p>Please enter your email address.</p>
    
    <form action="./_forgot-password" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      
      <div class="form-group">
        <input type="submit" value="Reset">
      </div>
    </form>

    <p>
      <a href="login.html">Back to Login</a>
    </p>
  </div>
</body>
</html>
