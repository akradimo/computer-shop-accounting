<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

class CSA_Products {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_products_menu'));
    }

    public function add_products_menu() {
        add_submenu_page(
            'csa-accounting',
            'مدیریت کالاها و خدمات',
            'کالاها و خدمات',
            'manage_options',
            'csa-products',
            array($this, 'render_products_page')
        );

        add_submenu_page(
            'csa-accounting',
            'افزودن کالا',
            'افزودن کالا',
            'manage_options',
            'csa-add-product',
            array($this, 'render_add_product_page')
        );

        add_submenu_page(
            'csa-accounting',
            'لیست کالاها',
            'لیست کالاها',
            'manage_options',
            'csa-list-products',
            array($this, 'render_list_products_page')
        );
    }

    public function render_products_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت کالاها و خدمات</h1>
            <p>در این بخش می‌توانید کالاها و خدمات را مدیریت کنید.</p>
        </div>
        <?php
    }

    public function render_add_product_page() {
        ?>
        <div class="wrap">
            <h1>افزودن کالا</h1>
            <form method="post" action="">
                <label for="product_name">نام:</label>
                <input type="text" name="product_name" id="product_name" required>
                <label for="product_price">قیمت:</label>
                <input type="number" step="0.01" name="product_price" id="product_price" required>
                <input type="submit" name="csa_add_product" value="افزودن کالا">
            </form>
        </div>
        <?php
    }

    public function render_list_products_page() {
        global $wpdb;
        $products = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_products");

        ?>
        <div class="wrap">
            <h1>لیست کالاها</h1>
            <table class="csa-table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>قیمت</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product->id; ?></td>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->price; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}