<div class="module-container">
    <div class="module-header">
        <h2>Manage Modules</h2>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <div class="module-grid">
        <!-- Add/Edit Module Form -->
        <div class="form-container">
            <form method="post" action="" class="module-form">
                <?php if (isset($editmodule)): ?>
                    <h3><i class="fas fa-edit"></i> Edit Module</h3>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($editmodule['id']) ?>">
                <?php else: ?>
                    <h3><i class="fas fa-plus-circle"></i> Add New Module</h3>
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Module Name:</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           required 
                           class="form-control"
                           value="<?= isset($editmodule) ? htmlspecialchars($editmodule['moduleName']) : '' ?>"
                           placeholder="Enter module name">
                </div>

                <div class="form-actions">
                    <?php if (isset($editmodule)): ?>
                        <button type="submit" name="update_module" class="btn-submit">
                            <i class="fas fa-save"></i> Update Module
                        </button>
                        <a href="modulen.php" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    <?php else: ?>
                        <button type="submit" name="add_module" class="btn-submit">
                            <i class="fas fa-plus"></i> Add Module
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Display Existing Modules -->
        <div class="table-container">
            <h3><i class="fas fa-list"></i> Existing Modules</h3>
            
            <?php if (empty($modulen)): ?>
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <p>No modules found</p>
                </div>
            <?php else: ?>
                <div class="module-list">
                    <?php foreach ($modulen as $module): ?>
                        <div class="module-item">
                            <div class="module-name">
                                <i class="fas fa-cube"></i>
                                <?= htmlspecialchars($module['moduleName']) ?>
                            </div>
                            <div class="module-actions">
                                <form method="post" action="" class="action-form">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($module['id']) ?>">
                                    <button type="submit" name="edit_module" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="submit" name="delete_module" class="btn-action btn-delete" 
                                            onclick="return confirm('Are you sure you want to delete this module?')">
                                        <i class="fas fa-trash"></i>
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