<form action="" method="post" enctype="multipart/form-data">
  <label for="posttext">Type your post here:</label><br>
  <textarea id="posttext" name="posttext" rows="3" cols="40"></textarea>
  <input type="file" name="fileToUpload">
  <select name="users">
      <option value="">Select an user</option>
      <?php foreach ($users as $user): ?>
        <option value="<?= $user['id']; ?>"><?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></option>
      <?php endforeach; ?>
  </select>
<select name="moduleid" id="moduleid">
  <option value="">Select a module</option>
  <?php foreach ($modules as $module): ?>
    <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>">
      <?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8'); ?>
    </option>
  <?php endforeach; ?>
</select>

  <input type="submit" name='submit' value="Add">
</form>