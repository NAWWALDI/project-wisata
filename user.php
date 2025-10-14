        <div class="sidebar-footer">
            <div class="user-account" onclick="toggleUserMenu()">
                <div class="user-avatar-sidebar"><?php echo $initials; ?></div>
                <div class="user-info-sidebar">
                    <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                    <span><?php echo str_replace('_', ' ', $user['role']); ?></span>
                </div>
                <i class="fas fa-chevron-up" id="user-chevron"></i>
            </div>

            <div class="user-menu" id="user-menu">
                <a href="profile_setting.php" class="user-menu-item">
                    <i class="fas fa-user"></i>
                    Profile Settings
                </a>
                <div class="user-menu-divider"></div>
                <a href="logout.php" class="user-menu-item logout-item" onclick="return confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>