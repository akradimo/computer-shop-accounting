<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Banking {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_banking_menu'));
    }

    public function add_banking_menu() {
        add_submenu_page(
            'csa-accounting',
            'مدیریت بانکداری',
            'بانکداری',
            'manage_options',
            'csa-banking',
            array($this, 'render_banking_page')
        );

        add_submenu_page(
            'csa-accounting',
            'موجودی نقد و بانک',
            'موجودی نقد و بانک',
            'manage_options',
            'csa-cash-bank',
            array($this, 'render_cash_bank_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن انتقال',
            'افزودن انتقال',
            'manage_options',
            'csa-add-transfer',
            array($this, 'render_add_transfer_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست انتقالات',
            'لیست انتقالات',
            'manage_options',
            'csa-list-transfers',
            array($this, 'render_list_transfers_page')
        );
    }

    public function render_banking_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت بانکداری</h1>
            <p>در این بخش می‌توانید موجودی نقد و بانک، انتقالات و چک‌ها را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_cash_bank_page() {
        global $wpdb;
        $balance = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}csa_bank_balance");

        ?>
        <div class="wrap">
            <h1>موجودی نقد و بانک</h1>
            <p>موجودی فعلی: <?php echo $balance->balance; ?></p>
        </div>
        <?php
    }

    public function render_add_transfer_page() {
        ?>
        <div class="wrap">
            <h1>افزودن انتقال</h1>
            <form method="post" action="">
                <label for="transfer_amount">مبلغ:</label>
                <input type="number" step="0.01" name="transfer_amount" id="transfer_amount" required>
                <label for="transfer_type">نوع:</label>
                <select name="transfer_type" id="transfer_type">
                    <option value="cash">نقدی</option>
                    <option value="bank">بانکی</option>
                </select>
                <input type="submit" name="csa_add_transfer" value="افزودن انتقال">
            </form>
        </div>
        <?php
    }

    public function render_list_transfers_page() {
        global $wpdb;
        $transfers = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_transfers");

        ?>
        <div class="wrap">
            <h1>لیست انتقالات</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>نوع</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transfers as $transfer): ?>
                    <tr>
                        <td><?php echo $transfer->id; ?></td>
                        <td><?php echo $transfer->amount; ?></td>
                        <td><?php echo $transfer->type; ?></td>
                        <td><?php echo $transfer->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}