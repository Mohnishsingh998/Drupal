<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class = "main">
    <form action="includes/formHandler.php" method="post">

    <label for="firstname">FirstName?</label> 
    <input id="firstname" type="text" name="firstname" placeholder="FirstName...." required>

    <label for="lastname">LastName?</label>
    <input id="lastname" type="text" name="lastname" placeholder="LastName...." required>

    <label for="Faviorate">Faviorate Programing Language</label>
    <select name="Faviorate" id="Faviorate">
      <option value="none">none</option>
      <option value="C++">C++</option>
      <option value="Java">Java</option>
      <option value="PHP">PHP</option>
    </select>

    <button type="submit" name="submits">Submit</button>

  </form>
  </main>
</body>
</html>