<div class="content">
  <p><?= $totalPosts ?> POST have been submitted to the Internet Joke Database.</p>

 <table class="Post-table">
  <tr>
    <th>Image</th>
    <th>Post Text</th>
    <th>post module</th>
    <th>user</th>
  </tr>

  <?php foreach ($posts as $post): ?>
    <tr>
      <td class="post-image">
        <?php if ($post['moduleName'] == 'meo meo'): ?>
          <img src="../image/meocry.jpg" alt="meomeo">
        <?php else: ?>
          <img src="../image/okay.jpg" alt="okey">
        <?php endif; ?>
      </td>

      <td class="post-text">
        <strong>Post Text:</strong>
        <?= htmlspecialchars($post['posttext'], ENT_QUOTES, 'UTF-8') ?>
      </td>

      <td class="post-module">
        <strong>post module:</strong>
        <?= htmlspecialchars($post['moduleName'], ENT_QUOTES, 'UTF-8') ?>
      </td>

      <td class="post-user">
        (by <?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8') ?>)
        <a href="editpost.php?id=<?= $post['id'] ?>">Edit</a>
      </td>

      <td class="post-delete">
        <form action="deletepost.php" method="post">
          <input type="hidden" name="id" value="<?= $post['id'] ?>">
          <input type="submit" value="Delete">
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
</div>
