<?php
// File: wp-content/plugins/computer-shop-accounting/includes/class-persons.php

if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Persons {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_persons_menu'));
    }

    public function add_persons_menu() {
        add_submenu_page(
            'csa-accounting', // اسلاگ منوی اصلی
            'لیست اشخاص', // عنوان صفحه
            'لیست اشخاص', // عنوان منو
            'manage_options', // سطح دسترسی
            'csa-list-persons', // اسلاگ منو
            array($this, 'render_list_persons_page') // تابع نمایش صفحه
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن شخص',
            'افزودن شخص',
            'manage_options',
            'csa-add-person',
            array($this, 'render_add_person_page')
        );
    }

    public function render_list_persons_page() {
        global $wpdb;
        $persons = $wpdb->get_results("SELECT id, display_name, person_type FROM {$wpdb->prefix}csa_persons");

        if ($wpdb->last_error) {
            echo '<div class="error"><p>خطا در دریافت اطلاعات از دیتابیس: ' . $wpdb->last_error . '</p></div>';
        }

        ?>
        <div class="wrap">
            <h1>لیست اشخاص</h1>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام نمایشی</th>
                        <th>نوع شخص</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($persons)): ?>
                        <?php foreach ($persons as $person): ?>
                            <tr>
                                <td><?php echo esc_html($person->id); ?></td>
                                <td><?php echo esc_html($person->display_name); ?></td>
                                <td><?php echo esc_html($person->person_type); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">هیچ شخصی یافت نشد.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_add_person_page() {
        include plugin_dir_path(__FILE__) . '../templates/add-person.php';
    }
}