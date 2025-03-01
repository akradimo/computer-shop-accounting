<?php
/*
Plugin Name: حسابداری فروشگاه کامپیوتر
Description: یک پلاگین جامع حسابداری برای فروشگاه‌های خدمات کامپیوتری و لوازم جانبی.
Version: 1.0
Author: نام شما
*/

if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

// فایل‌های لازم را شامل می‌شویم
require_once plugin_dir_path(__FILE__) . 'includes/class-database.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-persons.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-products.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-banking.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-sales.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-payments.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-income-expenses.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-inventory.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-accounting.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-reports.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-settings.php';

// مقداردهی اولیه پلاگین
function csa_init() {
    $csa_db = new CSA_Database();
    $csa_db->create_tables();

    // افزودن منوی اصلی
    add_menu_page(
        'حسابداری', // عنوان صفحه
        'حسابداری', // عنوان منو
        'manage_options', // سطح دسترسی
        'csa-accounting', // اسلاگ منو
        array('CSA_Accounting', 'render_accounting_page'), // تابع نمایش صفحه
        'dashicons-calculator', // آیکون
        6 // موقعیت منو
    );

    // افزودن زیرمنوها
    new CSA_Persons();
    new CSA_Products();
    new CSA_Banking();
    new CSA_Sales();
    new CSA_Payments();
    new CSA_Income_Expenses();
    new CSA_Inventory();
    new CSA_Reports();
    new CSA_Settings();
}
add_action('plugins_loaded', 'csa_init');

// افزودن اسکریپت‌ها و استایل‌ها
function csa_enqueue_scripts() {
    wp_enqueue_style('csa-style', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_script('csa-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'csa_enqueue_scripts');

// هوک‌های فعال‌سازی و غیرفعال‌سازی
register_activation_hook(__FILE__, array('CSA_Database', 'activate'));
register_deactivation_hook(__FILE__, array('CSA_Database', 'deactivate'));