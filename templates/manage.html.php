<h2>Manage users</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<!-- Add/Edit user Form -->
<form method="post" action="" class="mb-4">
    <?php if (isset($edituser)): ?>
        <h3>Edit user</h3>
        <input type="hidden" name="id" value="<?= htmlspecialchars($edituser['id']) ?>">
    <?php else: ?>
        <h3>Add New user</h3>
    <?php endif; ?>

    <div class="form-group">
        <label for="name">user Name:</label>
        <input type="text" name="name" id="name" required class="form-control"
            value="<?= isset($edituser) ? htmlspecialchars($edituser['name']) : '' ?>">
    </div>

    <div class="form-group">
        <label for="email">user Email:</label>
        <input type="email" name="email" id="email" class="form-control"
            value="<?= isset($edituser) ? htmlspecialchars($edituser['email']) : '' ?>">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control"
            <?= !isset($edituser) ? 'required' : '' ?>>
        <?php if (isset($edituser)): ?>
            <small class="form-text text-muted">Leave blank to keep current password</small>
        <?php endif; ?>
    </div>

    <?php if (isset($edituser)): ?>
        <button type="submit" name="update_user" class="btn btn-primary">Update user</button>
        <a href="manage.php" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
        <button type="submit" name="add_user" class="btn btn-primary">Add user</button>
    <?php endif; ?>
</form>

<!-- Display Existing users -->
<h3>Existing users</h3>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($users)): ?>
            <tr>
                <td colspan="3" class="text-center">No users found</td>
            </tr>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                            <button type="submit" name="edit_user" class="btn btn-warning btn-sm">Edit</button>
                        </form>
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                            <button type="submit" name="delete_user" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>