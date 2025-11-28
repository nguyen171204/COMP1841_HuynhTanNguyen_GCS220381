<div class="edit-post-container">
    <form action="" method="post" class="edit-post-form" enctype="multipart/form-data">
        <input type="hidden" name="postid" value="<?= htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8'); ?>">
        
        <div class="form-group">
            <label for="posttext">Edit your post here:</label>
            <textarea 
                id="posttext" 
                name="posttext" 
                rows="5" 
                class="form-control"
            ><?= htmlspecialchars($post['posttext'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="form-group">
            <label>Current Image:</label>
            <?php if (!empty($post['image'])): ?>
                <div class="current-image">
                    <img src="image/<?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Post image" style="max-width: 200px;">
                </div>
            <?php else: ?>
                <p>No image currently attached</p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="fileToUpload">Upload New Image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="users">Select user:</label>
            <select name="userid" id="users" class="form-control">
                <?php foreach ($users as $user): ?>
                    <option 
                        value="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?>"
                        <?= ($user['id'] == $post['userid']) ? 'selected' : ''; ?>
                    >
                        <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="modulen">Select module:</label>
            <select name="moduleid" id="modulen" class="form-control">
                <?php foreach ($modulen as $module): ?>
                    <option 
                        value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>"
                        <?= ($module['id'] == $post['moduleid']) ? 'selected' : ''; ?>
                    >
                        <?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn-submit">Save Changes</button>
        </div>
    </form>

    <?php if (isset($post['edited_by_admin']) && $post['edited_by_admin'] == 1): ?>
        <div class="admin-edit-note">
            <i class="fas fa-info-circle"></i>
            Last edited by admin on <?= htmlspecialchars(date('F j, Y, g:i a', strtotime($post['edit_date'])), ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
</div>