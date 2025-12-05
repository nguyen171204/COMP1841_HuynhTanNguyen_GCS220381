<?php

ob_start();

// Include file function + tạo $pdo
include __DIR__ . '/includes/DatabaseFunctions.php';


$users   = allUsers($pdo);
$modules = allModulen($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posttext = $_POST['posttext'] ?? '';
    $userid = isset($_POST['userid']) ? (int)$_POST['userid'] : null;
    $moduleid = isset($_POST['moduleid']) ? (int)$_POST['moduleid'] : null;
    
    
    error_log("Post Data: " . print_r($_POST, true));
    
   
    if (empty($userid) || empty($moduleid) || empty(trim($posttext))) {
        die("Error: All fields are required. UserID: " . ($userid ?? 'null') . 
             ", ModuleID: " . ($moduleid ?? 'null') . 
             ", Post Text: " . (!empty($posttext) ? 'provided' : 'empty'));
    }

    try {
       
        insertPost($pdo, $posttext, $userid, $moduleid);
        header('Location: posts.php');
        exit;
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage() . ". UserID: " . $userid);
    }
}


$title = 'Add New Question';


?>

<h2>Add New Question</h2>
<form action="addpost.php" method="post">
    <div>
        <label for="posttext">Question:</label>
        <textarea name="posttext" id="posttext" required></textarea>
    </div>
    <div>
        <label for="userid">User:</label>
        <select name="userid" id="userid" required>
            <option value="">Select a user</option>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name']) ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="" disabled>No users found</option>
            <?php endif; ?>
        </select>
    </div>
    <div>
        <label for="moduleid">Module:</label>
        <select name="moduleid" id="moduleid" required>
            <option value="">Select a module</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?= $module['id'] ?>"><?= htmlspecialchars($module['moduleName']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <button type="submit">Add Question</button>
    </div>
</form>

<?php

$output = ob_get_clean();


include __DIR__ . '/templates/layout.html.php';

