<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Inventory {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_inventory_menu'));
    }

    public function add_inventory_menu() {
        add_submenu_page(
            'csa-accounting',
            'مدیریت انبارداری',
            'انبارداری',
            'manage_options',
            'csa-inventory',
            array($this, 'render_inventory_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن انبار',
            'افزودن انبار',
            'manage_options',
            'csa-add-warehouse',
            array($this, 'render_add_warehouse_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست انبارها',
            'لیست انبارها',
            'manage_options',
            'csa-list-warehouses',
            array($this, 'render_list_warehouses_page')
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

    public function render_inventory_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت انبارداری</h1>
            <p>در این بخش می‌توانید انبارها و انتقالات را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_add_warehouse_page() {
        ?>
        <div class="wrap">
            <h1>افزودن انبار</h1>
            <form method="post" action="">
                <label for="warehouse_name">نام:</label>
                <input type="text" name="warehouse_name" id="warehouse_name" required>
                <label for="warehouse_location">مکان:</label>
                <input type="text" name="warehouse_location" id="warehouse_location" required>
                <input type="submit" name="csa_add_warehouse" value="افزودن انبار">
            </form>
        </div>
        <?php
    }

    public function render_list_warehouses_page() {
        global $wpdb;
        $warehouses = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_warehouses");

        ?>
        <div class="wrap">
            <h1>لیست انبارها</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>مکان</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($warehouses as $warehouse): ?>
                    <tr>
                        <td><?php echo $warehouse->id; ?></td>
                        <td><?php echo $warehouse->name; ?></td>
                        <td><?php echo $warehouse->location; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_add_transfer_page() {
        ?>
        <div class="wrap">
            <h1>افزودن انتقال</h1>
            <form method="post" action="">
                <label for="transfer_product">محصول:</label>
                <input type="text" name="transfer_product" id="transfer_product" required>
                <label for="transfer_quantity">تعداد:</label>
                <input type="number" name="transfer_quantity" id="transfer_quantity" required>
                <label for="transfer_from">از انبار:</label>
                <input type="text" name="transfer_from" id="transfer_from" required>
                <label for="transfer_to">به انبار:</label>
                <input type="text" name="transfer_to" id="transfer_to" required>
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
                        <th>محصول</th>
                        <th>تعداد</th>
                        <th>از انبار</th>
                        <th>به انبار</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transfers as $transfer): ?>
                    <tr>
                        <td><?php echo $transfer->id; ?></td>
                        <td><?php echo $transfer->product; ?></td>
                        <td><?php echo $transfer->quantity; ?></td>
                        <td><?php echo $transfer->from_warehouse; ?></td>
                        <td><?php echo $transfer->to_warehouse; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}