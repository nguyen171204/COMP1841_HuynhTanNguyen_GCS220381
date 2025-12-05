<?php
// ===== KẾT NỐI DATABASE – TẠO BIẾN $pdo =====
if (!isset($pdo)) {
    $host    = 'localhost';
    $db      = 'coursework'; // ĐÚNG tên database trong phpMyAdmin
    $user    = 'root';       // XAMPP mặc định
    $pass    = '';           // XAMPP mặc định là mật khẩu rỗng
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        echo 'Database connection failed: ' . $e->getMessage();
        exit;
    }
}
// ===== HẾT PHẦN KẾT NỐI DB =====


// ==== CÁC HÀM GỐC CỦA BẠN – GIỮ NGUYÊN ==== 

function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function updatepost($pdo, $postId, $posttext, $userid = null, $moduleid = null, $image = null, $is_admin = false)
{
    $query = 'UPDATE post SET posttext = :posttext';
    $parameters = [':posttext' => $posttext, ':id' => $postId];

    if ($userid !== null) {
        $query .= ', userid = :userid';
        $parameters[':userid'] = $userid;
    }

    if ($moduleid !== null) {
        $query .= ', moduleid = :moduleid';
        $parameters[':moduleid'] = $moduleid;
    }

    // Always update image field with the provided image value
    $query .= ', image = :image';
    $parameters[':image'] = $image;

    // Only set edited_by_admin and edit_date if it's an admin edit
    if ($is_admin) {
        $query .= ', edited_by_admin = 1, edit_date = NOW()';
    }

    $query .= ' WHERE id = :id';
    query($pdo, $query, $parameters);
}

function insertPost($pdo, $posttext, $userid, $moduleid) {
    $sql = 'INSERT INTO post (posttext, postdate, userid, moduleid)
            VALUES (:posttext, CURDATE(), :userid, :moduleid)';
    $parameters = [
        ':posttext' => $posttext,
        ':userid' => $userid,
        ':moduleid' => $moduleid
    ];
    query($pdo, $sql, $parameters);
}

function getpost($pdo, $id)
{
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT post.*, user.name, post.edit_date, module.moduleName 
            FROM post 
            LEFT JOIN user ON post.userid = user.id 
            LEFT JOIN module ON post.moduleid = module.id
            WHERE post.id = :id', $parameters);
    return $query->fetch();
}

function totalPosts($pdo) {
    $query = $pdo->query('SELECT COUNT(*) FROM post');
    $row = $query->fetch();
    return $row[0];
}

function allUsers($pdo) {
    $users = query($pdo, 'SELECT * FROM user');
    return $users->fetchAll(PDO::FETCH_ASSOC);
}

function allModulen($pdo) {
    $modules = query($pdo, 'SELECT * FROM module');
    return $modules->fetchAll(PDO::FETCH_ASSOC);
}

function allPosts($pdo) {
$sql = 'SELECT post.id, posttext, user.name AS username, 
                   user.email, module.moduleName 
            FROM post
            INNER JOIN user ON userid = user.id
            INNER JOIN module ON moduleid = module.id';
    $posts = query($pdo, $sql);
    return $posts->fetchAll(PDO::FETCH_ASSOC);
}

function deletepost($pdo, $id)
{
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM post WHERE id = :id', $parameters);
}

function getAllFeedback($pdo) {
    $query = 'SELECT user_message.*, user.name 
              FROM user_message 
              LEFT JOIN user ON user_message.user_id = user.id 
              ORDER BY time DESC';
    $feedback = query($pdo, $query);
    return $feedback->fetchAll();
}
?>