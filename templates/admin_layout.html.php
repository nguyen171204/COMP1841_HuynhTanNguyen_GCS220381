<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="../posts.css">
</head>
<body>
<header id ="admin">
  <h1>Greenwich Nguyen hihi</h1>
</header>

<nav>
  <ul>
    <li><a href="posts.php">Quetions List</a></li>
    <li><a href="addpost.php">Add a new Question</a></li>
    <li><a href="../admin/login/logout.php">Public Site/Logout</a></li>
    <li><a href="message.php">Feedback</a></li>
    <li><a href="manage.php">Manage Users</a></li>
    <li><a href="modulen.php">Manage Modulen</a></li>
  </ul>
</nav>

<main>
  <?= $output ?>
</main>
</body>
</html>
