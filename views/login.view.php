<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
  <link rel="stylesheet" href="../public/assests/register.css">
</head>
<body>

  <main>
    <h1>Login Here</h1>

    <form action="../Controller/login.controller.php" method="post">
      
      <label for="email">Email :</label>
      <input type="text" name="email" id="email" placeholder="Write your Email" required>

      <label for="password">Password :</label>
      <input type="password" name="password" id="password" placeholder="Enter Password" required>

      <button type="submit">Login</button>

    </form>

    <!-- 👇 Register Link -->
    <p class="redirect">
      Don't have an account? 
      <a href="../views/register.view.php">Register here</a>
    </p>

  </main>

</body>
</html>