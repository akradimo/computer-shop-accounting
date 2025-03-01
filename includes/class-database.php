<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class CSA_Database {
    public function __construct() {
        // Constructor
    }

    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = array();

        // Table for persons
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_persons (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            person_type varchar(50) NOT NULL,
            display_name varchar(255) NOT NULL,
            account_code varchar(50) NOT NULL,
            first_name varchar(255) NOT NULL,
            last_name varchar(255) NOT NULL,
            company varchar(255),
            tax_status varchar(255) NOT NULL,
            category varchar(255) NOT NULL,
            phone varchar(20),
            mobile varchar(20),
            fax varchar(20),
            email varchar(100),
            website varchar(255),
            country varchar(100),
            state varchar(100),
            city varchar(100),
            postal_code varchar(20),
            address text,
            national_code varchar(20),
            economic_code varchar(50),
            branch_code varchar(50),
            description text,
            bank_name varchar(255),
            card_number varchar(50),
            account_number varchar(50),
            sheba_number varchar(50),
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for products
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_products (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            price decimal(10, 2) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for bank balance
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_bank_balance (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            balance decimal(10, 2) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for transfers
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_transfers (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            type varchar(50) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for purchases
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_purchases (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for sales
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_sales (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for receipts
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_receipts (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for payments
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_payments (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for incomes
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_incomes (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for expenses
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_expenses (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for warehouses
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_warehouses (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            location varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for inventory transfers
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_inventory_transfers (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            product varchar(255) NOT NULL,
            quantity int NOT NULL,
            from_warehouse varchar(255) NOT NULL,
            to_warehouse varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for accounting documents
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_accounting_documents (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for salary documents
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_salary_documents (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            amount decimal(10, 2) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for balance sheet
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_balance_sheet (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            account varchar(255) NOT NULL,
            balance decimal(10, 2) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for profit and loss
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_profit_loss (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            account varchar(255) NOT NULL,
            amount decimal(10, 2) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Table for cash flow
        $sql[] = "CREATE TABLE {$wpdb->prefix}csa_cash_flow (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            account varchar(255) NOT NULL,
            amount decimal(10, 2) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        foreach ($sql as $query) {
            dbDelta($query);
        }
    }

    public static function activate() {
        // Activation code
        $csa_db = new CSA_Database();
        $csa_db->create_tables();
    }

    public static function deactivate() {
        // Deactivation code
        global $wpdb;

        $tables = array(
            "{$wpdb->prefix}csa_persons",
            "{$wpdb->prefix}csa_products",
            "{$wpdb->prefix}csa_bank_balance",
            "{$wpdb->prefix}csa_transfers",
            "{$wpdb->prefix}csa_purchases",
            "{$wpdb->prefix}csa_sales",
            "{$wpdb->prefix}csa_receipts",
            "{$wpdb->prefix}csa_payments",
            "{$wpdb->prefix}csa_incomes",
            "{$wpdb->prefix}csa_expenses",
            "{$wpdb->prefix}csa_warehouses",
            "{$wpdb->prefix}csa_inventory_transfers",
            "{$wpdb->prefix}csa_accounting_documents",
            "{$wpdb->prefix}csa_salary_documents",
            "{$wpdb->prefix}csa_balance_sheet",
            "{$wpdb->prefix}csa_profit_loss",
            "{$wpdb->prefix}csa_cash_flow"
        );

        foreach ($tables as $table) {
            $wpdb->query("DROP TABLE IF EXISTS $table");
        }
    }
}