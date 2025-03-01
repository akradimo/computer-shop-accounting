<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Sales {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_sales_menu'));
    }

    public function add_sales_menu() {
        add_submenu_page(
            'csa-accounting',
            'مدیریت فروش',
            'فروش',
            'manage_options',
            'csa-sales',
            array($this, 'render_sales_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن فاکتور خرید',
            'افزودن خرید',
            'manage_options',
            'csa-add-purchase',
            array($this, 'render_add_purchase_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست فاکتورهای خرید',
            'لیست خریدها',
            'manage_options',
            'csa-list-purchases',
            array($this, 'render_list_purchases_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن فاکتور فروش',
            'افزودن فروش',
            'manage_options',
            'csa-add-sales',
            array($this, 'render_add_sales_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست فاکتورهای فروش',
            'لیست فروش‌ها',
            'manage_options',
            'csa-list-sales',
            array($this, 'render_list_sales_page')
        );
    }

    public function render_sales_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت فروش</h1>
            <p>در این بخش می‌توانید فاکتورهای خرید و فروش را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_add_purchase_page() {
        ?>
        <div class="wrap">
            <h1>افزودن فاکتور خرید</h1>
            <form method="post" action="">
                <label for="purchase_amount">مبلغ:</label>
                <input type="number" step="0.01" name="purchase_amount" id="purchase_amount" required>
                <label for="purchase_date">تاریخ:</label>
                <input type="date" name="purchase_date" id="purchase_date" required>
                <input type="submit" name="csa_add_purchase" value="افزودن خرید">
            </form>
        </div>
        <?php
    }

    public function render_list_purchases_page() {
        global $wpdb;
        $purchases = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_purchases");

        ?>
        <div class="wrap">
            <h1>لیست فاکتورهای خرید</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($purchases as $purchase): ?>
                    <tr>
                        <td><?php echo $purchase->id; ?></td>
                        <td><?php echo $purchase->amount; ?></td>
                        <td><?php echo $purchase->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_add_sales_page() {
        ?>
        <div class="wrap">
            <h1>افزودن فاکتور فروش</h1>
            <form method="post" action="">
                <label for="sales_amount">مبلغ:</label>
                <input type="number" step="0.01" name="sales_amount" id="sales_amount" required>
                <label for="sales_date">تاریخ:</label>
                <input type="date" name="sales_date" id="sales_date" required>
                <input type="submit" name="csa_add_sales" value="افزودن فروش">
            </form>
        </div>
        <?php
    }

    public function render_list_sales_page() {
        global $wpdb;
        $sales = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_sales");

        ?>
        <div class="wrap">
            <h1>لیست فاکتورهای فروش</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td><?php echo $sale->id; ?></td>
                        <td><?php echo $sale->amount; ?></td>
                        <td><?php echo $sale->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}