<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
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