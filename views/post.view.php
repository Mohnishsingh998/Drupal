<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Post</title>
  <link rel="stylesheet" href="../public/assests/post.view.css">
</head>
<body>
  <main>
    <h1>Create the Post</h1>
    <form action="../Controller/post.controller.php" method="post" enctype="multipart/form-data">
      <label for="postimage">Pick image:</label>
      <input type="file" id="postimage" name="postimage" accept="image/*" required>
      <label for="caption">Image caption :</label>
      <input type="text" name="caption" id="caption" placeholder = "write about the post here" required>
      <button type="submit">Create the Post</button>
    </form>
  </main>
</body>
</html>