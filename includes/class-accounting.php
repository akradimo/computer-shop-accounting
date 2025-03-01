<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Accounting {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_accounting_menu'));
    }

    public function add_accounting_menu() {
        add_submenu_page(
            'csa-accounting',
            'مدیریت حسابداری',
            'حسابداری',
            'manage_options',
            'csa-accounting',
            array($this, 'render_accounting_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن سند حسابداری',
            'افزودن سند',
            'manage_options',
            'csa-add-document',
            array($this, 'render_add_document_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست اسناد حسابداری',
            'لیست اسناد',
            'manage_options',
            'csa-list-documents',
            array($this, 'render_list_documents_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن سند حقوق',
            'افزودن سند حقوق',
            'manage_options',
            'csa-add-salary',
            array($this, 'render_add_salary_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست اسناد حقوق',
            'لیست اسناد حقوق',
            'manage_options',
            'csa-list-salaries',
            array($this, 'render_list_salaries_page')
        );
    }

    public function render_accounting_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت حسابداری</h1>
            <p>در این بخش می‌توانید اسناد حسابداری و حقوق را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_add_document_page() {
        ?>
        <div class="wrap">
            <h1>افزودن سند حسابداری</h1>
            <form method="post" action="">
                <label for="document_amount">مبلغ:</label>
                <input type="number" step="0.01" name="document_amount" id="document_amount" required>
                <label for="document_date">تاریخ:</label>
                <input type="date" name="document_date" id="document_date" required>
                <input type="submit" name="csa_add_document" value="افزودن سند">
            </form>
        </div>
        <?php
    }

    public function render_list_documents_page() {
        global $wpdb;
        $documents = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_accounting_documents");

        ?>
        <div class="wrap">
            <h1>لیست اسناد حسابداری</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($documents as $document): ?>
                    <tr>
                        <td><?php echo $document->id; ?></td>
                        <td><?php echo $document->amount; ?></td>
                        <td><?php echo $document->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_add_salary_page() {
        ?>
        <div class="wrap">
            <h1>افزودن سند حقوق</h1>
            <form method="post" action="">
                <label for="salary_amount">مبلغ:</label>
                <input type="number" step="0.01" name="salary_amount" id="salary_amount" required>
                <label for="salary_date">تاریخ:</label>
                <input type="date" name="salary_date" id="salary_date" required>
                <input type="submit" name="csa_add_salary" value="افزودن سند حقوق">
            </form>
        </div>
        <?php
    }

    public function render_list_salaries_page() {
        global $wpdb;
        $salaries = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_salary_documents");

        ?>
        <div class="wrap">
            <h1>لیست اسناد حقوق</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salaries as $salary): ?>
                    <tr>
                        <td><?php echo $salary->id; ?></td>
                        <td><?php echo $salary->amount; ?></td>
                        <td><?php echo $salary->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}