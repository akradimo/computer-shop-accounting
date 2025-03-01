<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit; // خروج در صورت دسترسی مستقیم
}

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
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}csa_persons");


