jQuery(document).ready(function($) {
    // کد جاوااسکریپت برای پلاگین
    $('.csa-button').click(function() {
        alert('دکمه کلیک شد!');
    });
    // ویرایش گروه
    $('#edit-category').click(function() {
        // باز کردن یک پاپ‌آپ برای ویرایش گروه
        alert('این بخش برای ویرایش گروه در حال توسعه است.');
    });
      // مدیریت رویدادهای ویرایش و حذف
      $('.edit-person').click(function() {
        const personId = $(this).data('id');
        alert('ویرایش شخص با شناسه: ' + personId);
    });

    $('.delete-person').click(function() {
        const personId = $(this).data('id');
        if (confirm('آیا از حذف این شخص مطمئن هستید؟')) {
            alert('حذف شخص با شناسه: ' + personId);
        }
    });
});
