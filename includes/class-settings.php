<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Settings {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_settings_menu'));
    }

    public function add_settings_menu() {
        add_submenu_page(
            'csa-accounting',
            'تنظیمات',
            'تنظیمات',
            'manage_options',
            'csa-settings',
            array($this, 'render_settings_page')
        );

        add_submenu_page(
            'csa-accounting',
            'ویرایش کسب و کار',
            'ویرایش کسب و کار',
            'manage_options',
            'csa-edit-business',
            array($this, 'render_edit_business_page')
        );

        add_submenu_page(
            'csa-accounting',
            'سطح دسترسی',
            'سطح دسترسی',
            'manage_options',
            'csa-access-levels',
            array($this, 'render_access_levels_page')
        );

        add_submenu_page(
            'csa-accounting',
            'تنظیمات مالی',
            'تنظیمات مالی',
            'manage_options',
            'csa-financial-settings',
            array($this, 'render_financial_settings_page')
        );
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>تنظیمات</h1>
            <p>در این بخش می‌توانید تنظیمات پلاگین را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_edit_business_page() {
        ?>
        <div class="wrap">
            <h1>ویرایش کسب و کار</h1>
            <form method="post" action="">
                <label for="business_name">نام کسب و کار:</label>
                <input type="text" name="business_name" id="business_name" required>
                <label for="business_address">آدرس:</label>
                <input type="text" name="business_address" id="business_address" required>
                <input type="submit" name="csa_edit_business" value="ذخیره تغییرات">
            </form>
        </div>
        <?php
    }

    public function render_access_levels_page() {
        ?>
        <div class="wrap">
            <h1>سطح دسترسی</h1>
            <form method="post" action="">
                <label for="access_level">سطح دسترسی:</label>
                <select name="access_level" id="access_level">
                    <option value="admin">مدیر</option>
                    <option value="manager">مدیر فروش</option>
                    <option value="employee">کارمند</option>
                </select>
                <input type="submit" name="csa_set_access_level" value="تنظیم سطح دسترسی">
            </form>
        </div>
        <?php
    }

    public function render_financial_settings_page() {
        ?>
        <div class="wrap">
            <h1>تنظیمات مالی</h1>
            <form method="post" action="">
                <label for="currency">واحد پول:</label>
                <input type="text" name="currency" id="currency" required>
                <label for="tax_rate">نرخ مالیات:</label>
                <input type="number" step="0.01" name="tax_rate" id="tax_rate" required>
                <input type="submit" name="csa_set_financial_settings" value="ذخیره تنظیمات">
            </form>
        </div>
        <?php
    }
}