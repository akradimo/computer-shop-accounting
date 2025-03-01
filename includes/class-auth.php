<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class CSA_Auth {
    public function __construct() {
        add_action('init', array($this, 'handle_login'));
    }

    public function handle_login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['csa_login'])) {
            $username = sanitize_user($_POST['username']);
            $password = sanitize_text_field($_POST['password']);

            $user = wp_authenticate($username, $password);

            if (is_wp_error($user)) {
                echo '<div class="error">Invalid username or password.</div>';
            } else {
                wp_set_auth_cookie($user->ID);
                wp_redirect(admin_url('admin.php?page=csa-dashboard'));
                exit;
            }
        }
    }

    public function render_login_form() {
        ?>
        <div class="csa-login-form">
            <h2>Login</h2>
            <form method="post" action="">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <input type="submit" name="csa_login" value="Login">
            </form>
        </div>
        <?php
    }
}