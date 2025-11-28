<div class="content">
  <p><?= $totalPosts ?> Posts have been submitted to the Internet post Database.</p>

 <table class="post-table">
  <tr>
    <th>Image</th>
    <th>PostText</th>
    <th>Post Module</th>
    <th>User</th>
  </tr>

  <?php foreach ($posts as $post): ?>
    <tr>
      <td class="post-image">
        <?php if ($post['moduleName'] == 'meo meo'): ?>
          <img src="image/meocry.jpg" alt="meomeo">
        <?php else: ?>
          <img src="image/okay.jpg" alt="okey">
        <?php endif; ?>
      </td>

      <td class="post-text">
        <strong>Post Text:</strong>
        <?= htmlspecialchars($post['posttext'], ENT_QUOTES, 'UTF-8') ?>
      </td>

      <td class="post-module">
        <strong>Post Module:</strong>
        <?= htmlspecialchars($post['moduleName'], ENT_QUOTES, 'UTF-8') ?>
      </td>

      <td class="post-user">
        (by <?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8') ?>)
      </td>

    </tr>
  <?php endforeach; ?>
</table>
</div>
