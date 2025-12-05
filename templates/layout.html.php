<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/COMP1841/HuynhTanNguyen_GCS220381_COMP1841/posts.css">

    <title><?= $title ?></title>
</head>

<body>
    <header>
        <h1>Greenwich hahaha</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="posts.php">Question List</a></li>
            <li><a href="addpost.php">Add Questions</a></li>
            <li><a href="modulen.php">Module</a></li>
            <li><a href="manage.php">User</a></li>
            <li><a href="admin/login/Login.html">Admin Login</a></li>
            <li><a href="feedback.php">Feedback</a></li> 
        </ul>
    </nav>
    <main>
        <?= $output ?>
    </main>
    <footer>&copy; FPT GreenwichVN</footer>
</body>

</html>