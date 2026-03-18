<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register_User</title>
  <link rel="stylesheet" href="../public/assests/register.css">
</head>
<body>
  <main>
    <h1>Signup Here</h1>
    <form action="../Controller/register.controller.php" method="post" enctype="multipart/form-data">
      <label for="name">username :</label>
      <input type="text" name="name" id="name" placeholder = "Write your username" required>
      <label for="email">email :</label>
      <input type="text" name="email" id="email" placeholder = "Write your Email" required>
      <label for="password">password :</label>
      <input type="text" name="password" id="password" placeholder = "Enter Password." required>
      <label for="bio">Tell about Yourself :</label>
      <input type="text" name="bio" id="bio" placeholder = "Write about Yourself" required>
      <label for="profileimage">Profile Image:</label>
      <input type="file" id="profileimage" name="profileimage" accept="image/*" required>
      <button type="submit">Sign Up</button>
    </form>

      <p class="redirect">
      Already have an account? 
      <a href="../views/login.view.php">login here</a>
      </p>

  </main>
</body>
</html>