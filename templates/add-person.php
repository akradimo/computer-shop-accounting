<?php
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

global $wpdb;

// ذخیره اطلاعات فرم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['csa_add_person'])) {
    $person_type = sanitize_text_field($_POST['person_type']);
    $display_name = sanitize_text_field($_POST['display_name']);
    $account_code = sanitize_text_field($_POST['account_code']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $company = sanitize_text_field($_POST['company']);
    $tax_status = sanitize_text_field($_POST['tax_status']);
    $category = sanitize_text_field($_POST['category']);
    $phone = sanitize_text_field($_POST['phone']);
    $mobile = sanitize_text_field($_POST['mobile']);
    $fax = sanitize_text_field($_POST['fax']);
    $email = sanitize_email($_POST['email']);
    $website = esc_url_raw($_POST['website']);
    $country = sanitize_text_field($_POST['country']);
    $state = sanitize_text_field($_POST['state']);
    $city = sanitize_text_field($_POST['city']);
    $postal_code = sanitize_text_field($_POST['postal_code']);
    $address = sanitize_text_field($_POST['address']);
    $national_code = sanitize_text_field($_POST['national_code']);
    $economic_code = sanitize_text_field($_POST['economic_code']);
    $branch_code = sanitize_text_field($_POST['branch_code']);
    $description = sanitize_textarea_field($_POST['description']);
    $bank_name = sanitize_text_field($_POST['bank_name']);
    $card_number = sanitize_text_field($_POST['card_number']);
    $account_number = sanitize_text_field($_POST['account_number']);
    $sheba_number = sanitize_text_field($_POST['sheba_number']);

    // اعتبارسنجی کد ملی ایرانی
    if (!empty($national_code)) {
        if (!validate_national_code($national_code)) {
            echo '<div class="error"><p>کد ملی وارد شده معتبر نیست.</p></div>';
            return;
        }
    }

    // ذخیره اطلاعات در دیتابیس
    $wpdb->insert(
        "{$wpdb->prefix}csa_persons",
        array(
            'person_type' => $person_type,
            'display_name' => $display_name,
            'account_code' => $account_code,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'company' => $company,
            'tax_status' => $tax_status,
            'category' => $category,
            'phone' => $phone,
            'mobile' => $mobile,
            'fax' => $fax,
            'email' => $email,
            'website' => $website,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'postal_code' => $postal_code,
            'address' => $address,
            'national_code' => $national_code,
            'economic_code' => $economic_code,
            'branch_code' => $branch_code,
            'description' => $description,
            'bank_name' => $bank_name,
            'card_number' => $card_number,
            'account_number' => $account_number,
            'sheba_number' => $sheba_number
        )
    );

    echo '<div class="updated"><p>شخص با موفقیت افزوده شد.</p></div>';
}

// تابع اعتبارسنجی کد ملی ایرانی
function validate_national_code($national_code) {
    if (strlen($national_code) != 10) {
        return false;
    }

    $sum = 0;
    for ($i = 0; $i < 9; $i++) {
        $sum += (int)$national_code[$i] * (10 - $i);
    }

    $remainder = $sum % 11;
    $control_digit = (int)$national_code[9];

    if (($remainder < 2 && $control_digit == $remainder) || ($remainder >= 2 && $control_digit == (11 - $remainder))) {
        return true;
    }

    return false;
}
?>

<div class="wrap">
    <h1>افزودن شخص</h1>
    <form method="post" action="">
        <h2>اطلاعات اصلی</h2>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="person_type">نوع شخص</label></th>
                <td>
                    <select name="person_type" id="person_type" required>
                        <option value="حقیقی">حقیقی</option>
                        <option value="حقوقی">حقوقی</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="display_name">نام نمایشی</label></th>
                <td><input type="text" name="display_name" id="display_name" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="account_code">کد حسابداری</label></th>
                <td>
                    <input type="text" name="account_code" id="account_code" required>
                    <p class="description">کد حسابداری به صورت خودکار تولید می‌شود یا می‌توانید به صورت دستی وارد کنید.</p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="first_name">نام</label></th>
                <td><input type="text" name="first_name" id="first_name" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="last_name">نام خانوادگی</label></th>
                <td><input type="text" name="last_name" id="last_name" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="company">شرکت</label></th>
                <td><input type="text" name="company" id="company"></td>
            </tr>
            <tr>
                <th scope="row"><label for="tax_status">مشمولیت مالیات</label></th>
                <td>
                    <select name="tax_status" id="tax_status" required>
                        <option value="مودی مشمول ثبت نام در نظام مالیاتی">مودی مشمول ثبت نام در نظام مالیاتی</option>
                        <option value="مشمولین حقیقی ماده 81 ق.م.م">مشمولین حقیقی ماده 81 ق.م.م</option>
                        <option value="اشخاصی که ملزم به ثبت نام در نظام مالیاتی نیستند">اشخاصی که ملزم به ثبت نام در نظام مالیاتی نیستند</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="category">دسته بندی</label></th>
                <td>
                    <input type="text" name="category" id="category" value="اشخاص" readonly>
                    <button type="button" class="button" id="edit-category">ویرایش گروه</button>
                </td>
            </tr>
        </table>

        <h2>تماس</h2>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="phone">تلفن</label></th>
                <td><input type="text" name="phone" id="phone"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mobile">موبایل</label></th>
                <td><input type="text" name="mobile" id="mobile"></td>
            </tr>
            <tr>
                <th scope="row"><label for="fax">فکس</label></th>
                <td><input type="text" name="fax" id="fax"></td>
            </tr>
            <tr>
                <th scope="row"><label for="email">ایمیل</label></th>
                <td><input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <th scope="row"><label for="website">وبسایت</label></th>
                <td><input type="url" name="website" id="website"></td>
            </tr>
        </table>

        <h2>آدرس</h2>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="country">کشور</label></th>
                <td><input type="text" name="country" id="country"></td>
            </tr>
            <tr>
                <th scope="row"><label for="state">استان</label></th>
                <td><input type="text" name="state" id="state"></td>
            </tr>
            <tr>
                <th scope="row"><label for="city">شهرستان</label></th>
                <td><input type="text" name="city" id="city"></td>
            </tr>
            <tr>
                <th scope="row"><label for="postal_code">کد پستی</label></th>
                <td><input type="text" name="postal_code" id="postal_code"></td>
            </tr>
            <tr>
                <th scope="row"><label for="address">آدرس</label></th>
                <td><textarea name="address" id="address" rows="5"></textarea></td>
            </tr>
        </table>

        <h2>عمومی</h2>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="national_code">کد ملی ایرانی</label></th>
                <td><input type="text" name="national_code" id="national_code"></td>
            </tr>
            <tr>
                <th scope="row"><label for="economic_code">کد اقتصادی</label></th>
                <td><input type="text" name="economic_code" id="economic_code"></td>
            </tr>
            <tr>
                <th scope="row"><label for="branch_code">کد شعبه</label></th>
                <td><input type="text" name="branch_code" id="branch_code"></td>
            </tr>
            <tr>
                <th scope="row"><label for="description">توضیحات</label></th>
                <td><textarea name="description" id="description" rows="5"></textarea></td>
            </tr>
        </table>

        <h2>حساب بانکی</h2>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="bank_name">بانک</label></th>
                <td><input type="text" name="bank_name" id="bank_name"></td>
            </tr>
            <tr>
                <th scope="row"><label for="card_number">شماره کارت</label></th>
                <td><input type="text" name="card_number" id="card_number"></td>
            </tr>
            <tr>
                <th scope="row"><label for="account_number">شماره حساب</label></th>
                <td><input type="text" name="account_number" id="account_number"></td>
            </tr>
            <tr>
                <th scope="row"><label for="sheba_number">شماره شبا</label></th>
                <td><input type="text" name="sheba_number" id="sheba_number"></td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" name="csa_add_person" class="button-primary" value="افزودن شخص">
        </p>
    </form>
</div>

<script>
jQuery(document).ready(function($) {
    // ویرایش گروه
    $('#edit-category').click(function() {
        // باز کردن یک پاپ‌آپ برای ویرایش گروه
        alert('این بخش برای ویرایش گروه در حال توسعه است.');
    });
});
</script>