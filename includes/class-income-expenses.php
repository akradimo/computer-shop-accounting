<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Income_Expenses {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_income_expenses_menu'));
    }

    public function add_income_expenses_menu() {
        add_submenu_page(
            'csa-accounting',
            'مدیریت درآمد و هزینه',
            'درآمد و هزینه',
            'manage_options',
            'csa-income-expenses',
            array($this, 'render_income_expenses_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن درآمد',
            'افزودن درآمد',
            'manage_options',
            'csa-add-income',
            array($this, 'render_add_income_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست درآمدها',
            'لیست درآمدها',
            'manage_options',
            'csa-list-incomes',
            array($this, 'render_list_incomes_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن هزینه',
            'افزودن هزینه',
            'manage_options',
            'csa-add-expense',
            array($this, 'render_add_expense_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست هزینه‌ها',
            'لیست هزینه‌ها',
            'manage_options',
            'csa-list-expenses',
            array($this, 'render_list_expenses_page')
        );
    }

    public function render_income_expenses_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت درآمد و هزینه</h1>
            <p>در این بخش می‌توانید درآمدها و هزینه‌ها را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_add_income_page() {
        ?>
        <div class="wrap">
            <h1>افزودن درآمد</h1>
            <form method="post" action="">
                <label for="income_amount">مبلغ:</label>
                <input type="number" step="0.01" name="income_amount" id="income_amount" required>
                <label for="income_date">تاریخ:</label>
                <input type="date" name="income_date" id="income_date" required>
                <input type="submit" name="csa_add_income" value="افزودن درآمد">
            </form>
        </div>
        <?php
    }

    public function render_list_incomes_page() {
        global $wpdb;
        $incomes = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_incomes");

        ?>
        <div class="wrap">
            <h1>لیست درآمدها</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incomes as $income): ?>
                    <tr>
                        <td><?php echo $income->id; ?></td>
                        <td><?php echo $income->amount; ?></td>
                        <td><?php echo $income->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_add_expense_page() {
        ?>
        <div class="wrap">
            <h1>افزودن هزینه</h1>
            <form method="post" action="">
                <label for="expense_amount">مبلغ:</label>
                <input type="number" step="0.01" name="expense_amount" id="expense_amount" required>
                <label for="expense_date">تاریخ:</label>
                <input type="date" name="expense_date" id="expense_date" required>
                <input type="submit" name="csa_add_expense" value="افزودن هزینه">
            </form>
        </div>
        <?php
    }

    public function render_list_expenses_page() {
        global $wpdb;
        $expenses = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_expenses");

        ?>
        <div class="wrap">
            <h1>لیست هزینه‌ها</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($expenses as $expense): ?>
                    <tr>
                        <td><?php echo $expense->id; ?></td>
                        <td><?php echo $expense->amount; ?></td>
                        <td><?php echo $expense->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}