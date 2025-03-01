<?php
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
            'مدیریت اشخاص', // عنوان صفحه
            'اشخاص', // عنوان منو
            'manage_options', // سطح دسترسی
            'csa-persons', // اسلاگ منو
            array($this, 'render_persons_page') // تابع نمایش صفحه
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن شخص',
            'افزودن شخص',
            'manage_options',
            'csa-add-person',
            array($this, 'render_add_person_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست اشخاص',
            'لیست اشخاص',
            'manage_options',
            'csa-list-persons',
            array($this, 'render_list_persons_page')
        );
    }

    public function render_persons_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت اشخاص</h1>
            <p>در این بخش می‌توانید اشخاص، سهامداران و بازاریاب‌ها را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_add_person_page() {
        include plugin_dir_path(__FILE__) . '../templates/add-person.php';
    }

    public function render_list_persons_page() {
        global $wpdb;
        $persons = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_persons");

        ?>
        <div class="wrap">
            <h1>لیست اشخاص</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>نوع</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($persons as $person): ?>
                    <tr>
                        <td><?php echo $person->id; ?></td>
                        <td><?php echo $person->name; ?></td>
                        <td><?php echo $person->type; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}