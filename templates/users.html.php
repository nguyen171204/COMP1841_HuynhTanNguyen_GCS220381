<div class="dashboard-container">
    <div class="dashboard-header">
        <h2><i class="fas fa-users-cog"></i> User Management</h2>
        <p class="header-subtitle">Manage your system users</p>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <?= htmlspecialchars($_GET['error']) ?>
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <div class="dashboard-grid">
        <!-- Add/Edit User Form -->
        <div class="card form-card">
            <div class="card-header">
                <?php if (isset($edituser)): ?>
                    <h3><i class="fas fa-user-edit"></i> Edit User Profile</h3>
                    <p class="card-subtitle">Update user information</p>
                <?php else: ?>
                    <h3><i class="fas fa-user-plus"></i> New User</h3>
                    <p class="card-subtitle">Create a new user account</p>
                <?php endif; ?>
            </div>

            <form method="post" action="" class="styled-form">
                <?php if (isset($edituser)): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($edituser['id']) ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user"></i>
                        <span>Full Name</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           required 
                           class="form-control"
                           value="<?= isset($edituser) ? htmlspecialchars($edituser['name']) : '' ?>"
                           placeholder="Enter full name">
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        <span>Email Address</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           required 
                           class="form-control"
                           value="<?= isset($edituser) ? htmlspecialchars($edituser['email']) : '' ?>"
                           placeholder="Enter email address">
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        <span><?= isset($edituser) ? 'New Password (optional)' : 'Password' ?></span>
                    </label>
                    <div class="password-input-group">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control"
                               <?= isset($edituser) ? '' : 'required' ?>
                               placeholder="<?= isset($edituser) ? 'Leave blank to keep current' : 'Enter password' ?>">
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-actions">
                    <?php if (isset($edituser)): ?>
                        <button type="submit" name="update_user" class="btn-submit">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="users.php" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    <?php else: ?>
                        <button type="submit" name="add_user" class="btn-submit">
                            <i class="fas fa-plus"></i> Create User
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Display Existing Users -->
        <div class="card list-card">
            <div class="card-header">
                <h3><i class="fas fa-users"></i> User Directory</h3>
                <p class="card-subtitle">Manage existing users</p>
            </div>
            
            <?php if (empty($users)): ?>
                <div class="empty-state">
                    <i class="fas fa-user-friends"></i>
                    <p>No users found in the system</p>
                    <span class="empty-state-hint">Add your first user using the form</span>
                </div>
            <?php else: ?>
                <div class="user-list">
                    <?php foreach ($users as $user): ?>
                        <div class="user-card">
                            <div class="user-card-content">
                                <div class="user-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="user-details">
                                    <h4 class="user-name">
                                        <?= htmlspecialchars($user['name']) ?>
                                    </h4>
                                    <span class="user-email">
                                        <i class="fas fa-envelope"></i>
                                        <?= htmlspecialchars($user['email']) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="user-actions">
                                <form method="post" action="" class="action-form">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                                    <button type="submit" name="edit_user" class="btn-action btn-edit" title="Edit User">
                                        <i class="fas fa-edit"></i>
                                        <span class="action-label">Edit</span>
                                    </button>
                                    <button type="submit" name="delete_user" class="btn-action btn-delete" 
                                            onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')"
                                            title="Delete User">
                                        <i class="fas fa-trash"></i>
                                        <span class="action-label">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
