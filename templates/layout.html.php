<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="posts.css">
</head>
<body>
<header>
  <h1>Student Forum</h1>
</header>

<nav>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="posts.php">Question List</a></li>
    <li><a href="manage.php"> User</a></li>
    <li><a href="modulen.php">  Module</a></li>
    <li><a href="admin/login/login.html">Admin Login</a></li>
    <li><a href="feedback.php">Feedback</a></li> 
  </ul>
</nav>

<main>
  <?= $output ?>
</main>
</body>
</html>
