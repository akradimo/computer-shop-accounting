<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Payments {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_payments_menu'));
    }

    public function add_payments_menu() {
        add_submenu_page(
            'csa-accounting',
            'مدیریت دریافت و پرداخت',
            'دریافت و پرداخت',
            'manage_options',
            'csa-payments',
            array($this, 'render_payments_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن دریافت',
            'افزودن دریافت',
            'manage_options',
            'csa-add-receipt',
            array($this, 'render_add_receipt_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست دریافت‌ها',
            'لیست دریافت‌ها',
            'manage_options',
            'csa-list-receipts',
            array($this, 'render_list_receipts_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن پرداخت',
            'افزودن پرداخت',
            'manage_options',
            'csa-add-payment',
            array($this, 'render_add_payment_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست پرداخت‌ها',
            'لیست پرداخت‌ها',
            'manage_options',
            'csa-list-payments',
            array($this, 'render_list_payments_page')
        );
    }

    public function render_payments_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت دریافت و پرداخت</h1>
            <p>در این بخش می‌توانید دریافت‌ها و پرداخت‌ها را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_add_receipt_page() {
        ?>
        <div class="wrap">
            <h1>افزودن دریافت</h1>
            <form method="post" action="">
                <label for="receipt_amount">مبلغ:</label>
                <input type="number" step="0.01" name="receipt_amount" id="receipt_amount" required>
                <label for="receipt_date">تاریخ:</label>
                <input type="date" name="receipt_date" id="receipt_date" required>
                <input type="submit" name="csa_add_receipt" value="افزودن دریافت">
            </form>
        </div>
        <?php
    }

    public function render_list_receipts_page() {
        global $wpdb;
        $receipts = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_receipts");

        ?>
        <div class="wrap">
            <h1>لیست دریافت‌ها</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($receipts as $receipt): ?>
                    <tr>
                        <td><?php echo $receipt->id; ?></td>
                        <td><?php echo $receipt->amount; ?></td>
                        <td><?php echo $receipt->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_add_payment_page() {
        ?>
        <div class="wrap">
            <h1>افزودن پرداخت</h1>
            <form method="post" action="">
                <label for="payment_amount">مبلغ:</label>
                <input type="number" step="0.01" name="payment_amount" id="payment_amount" required>
                <label for="payment_date">تاریخ:</label>
                <input type="date" name="payment_date" id="payment_date" required>
                <input type="submit" name="csa_add_payment" value="افزودن پرداخت">
            </form>
        </div>
        <?php
    }

    public function render_list_payments_page() {
        global $wpdb;
        $payments = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_payments");

        ?>
        <div class="wrap">
            <h1>لیست پرداخت‌ها</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?php echo $payment->id; ?></td>
                        <td><?php echo $payment->amount; ?></td>
                        <td><?php echo $payment->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}