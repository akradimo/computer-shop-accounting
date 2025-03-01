<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Reports {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_reports_menu'));
    }

    public function add_reports_menu() {
        add_submenu_page(
            'csa-accounting',
            'مدیریت گزارشات',
            'گزارشات',
            'manage_options',
            'csa-reports',
            array($this, 'render_reports_page')
        );

        add_submenu_page(
            'csa-accounting',
            'ترازنامه',
            'ترازنامه',
            'manage_options',
            'csa-balance-sheet',
            array($this, 'render_balance_sheet_page')
        );

        add_submenu_page(
            'csa-accounting',
            'صورت سود و زیان',
            'سود و زیان',
            'manage_options',
            'csa-profit-loss',
            array($this, 'render_profit_loss_page')
        );

        add_submenu_page(
            'csa-accounting',
            'گردش حساب بانک',
            'گردش حساب بانک',
            'manage_options',
            'csa-bank-flow',
            array($this, 'render_bank_flow_page')
        );
    }

    public function render_reports_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت گزارشات</h1>
            <p>در این بخش می‌توانید گزارشات مالی را مشاهده کنید.</p>
        </div>
        <?php
    }

    public function render_balance_sheet_page() {
        global $wpdb;
        $balance_sheet = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_balance_sheet");

        ?>
        <div class="wrap">
            <h1>ترازنامه</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>حساب</th>
                        <th>موجودی</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($balance_sheet as $item): ?>
                    <tr>
                        <td><?php echo $item->id; ?></td>
                        <td><?php echo $item->account; ?></td>
                        <td><?php echo $item->balance; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_profit_loss_page() {
        global $wpdb;
        $profit_loss = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_profit_loss");

        ?>
        <div class="wrap">
            <h1>صورت سود و زیان</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>حساب</th>
                        <th>مبلغ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($profit_loss as $item): ?>
                    <tr>
                        <td><?php echo $item->id; ?></td>
                        <td><?php echo $item->account; ?></td>
                        <td><?php echo $item->amount; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_bank_flow_page() {
        global $wpdb;
        $bank_flow = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_bank_flow");

        ?>
        <div class="wrap">
            <h1>گردش حساب بانک</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>حساب</th>
                        <th>مبلغ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bank_flow as $item): ?>
                    <tr>
                        <td><?php echo $item->id; ?></td>
                        <td><?php echo $item->account; ?></td>
                        <td><?php echo $item->amount; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}