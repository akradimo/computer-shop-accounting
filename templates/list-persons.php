<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

global $wpdb;

// دریافت لیست اشخاص از دیتابیس
$persons = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}csa_persons");
?>

<div class="wrap p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">لیست اشخاص</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کد حسابداری</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نام نمایشی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">دسته بندی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نوع شخص</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">مشمولیت مالیات</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شرکت</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نام</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نام خانوادگی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تلفن</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">موبایل</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ایمیل</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کد ملی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کد اقتصادی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شماره ثبت</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">توضیحات</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کشور</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">استان</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شهر</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">آدرس</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کدپستی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">فکس</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">سایت</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($persons as $index => $person): ?>
                <tr>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo $index + 1; ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->account_code); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->display_name); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->category); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->person_type); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->tax_status); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->company); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->first_name); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->last_name); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->phone); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->mobile); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->email); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->national_code); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->economic_code); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->branch_code); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->description); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->country); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->state); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->city); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->address); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->postal_code); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->fax); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900"><?php echo esc_html($person->website); ?></td>
                    <td class="px-6 py-4 text-right text-sm text-gray-900">
                        <div class="flex space-x-2">
                            <button class="text-indigo-600 hover:text-indigo-900">ویرایش</button>
                            <button class="text-red-600 hover:text-red-900">حذف</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>