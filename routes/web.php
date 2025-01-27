<?php

use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\SitemapController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('/');
    Route::get('/category-wise-tender/{id}', 'categoryWiseTender')->name('category_wise_tender');
    Route::get('/preview-front-tender/{id}', 'previewFrontTender')->name('preview_front_tender');
});

Route::get('/sitemap.xml', [SitemapController::class, 'generateSitemap'])->name('sitemap');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [CMSController::class, 'dashboard'])->name('dashboard');

    Route::controller(MemberController::class)->prefix('/admin')->group(function () {
        Route::get('/show-payment-verification', 'showPaymentVerification')->name('show_payment_verification');
        Route::post('/save-payment-verification', 'savePaymentVerification')->name('save_payment_verification');
        Route::get('/manage-payment-verification', 'managePaymentVerification')->name('manage_payment_verification');
        Route::get('/edit-payment-verification/{id}', 'editPaymentVerification')->name('edit_payment_verification');
        Route::post('/update-payment-verification', 'updatePaymentVerification')->name('update_payment_verification');
        Route::delete('/delete-payment-verification', 'deletePaymentVerification')->name('delete_payment_verification');
    });

    Route::controller(CMSController::class)->prefix('/admin')->group(function () {
        Route::get('/preview-tender/{id}', 'previewTender')->name('preview_tender');
        Route::get('/all-tender', 'allTender')->name('all_tender');
    });

    Route::controller(AjaxController::class)->name('ajax.')->group(function () {

        //ajax filter
        Route::get('/sort-tender/{id}', 'sortTender')->name('sort_tender');

        //ajax search
        Route::get('/search-tender', 'searchTender')->name('search_tender_route');

    });
});

Route::middleware(['superAdmin'])->group(function () {
    Route::controller(AdminController::class)->prefix('/admin')->group(function () {
        Route::get('/role/{id}/{newRole}', 'role')->name('role');
        Route::get('/manage-admin', 'manageAdmin')->name('manage_admin');
        Route::get('/edit-admin/{id}', 'editAdmin')->name('edit_admin');
        Route::delete('/delete-admin/{id}', 'deleteAdmin')->name('delete_admin');
        Route::post('/update-user-name', 'updateUserName')->name('update_user_name');
        Route::post('/update-user-phone', 'updateUserPhone')->name('update_user_phone');
        Route::post('/update-user-email', 'updateUserEmail')->name('update_user_email');
        Route::post('/update-user-photo', 'updateUserPhoto')->name('update_user_photo');
        Route::post('/update-user-password', 'updateUserPassword')->name('update_user_password');
        Route::post('/update-user-address', 'updateUserAddress')->name('update_user_address');
        Route::post('/update-user-organization', 'updateUserOrganization')->name('update_user_organization');
        Route::post('/update-user-nid', 'updateUserNID')->name('update_user_nid');
        Route::get('/pending-user', 'pendingUser')->name('pending_user');
        Route::get('/admin-user', 'adminUser')->name('admin_user');
        Route::get('/super-admin-user', 'superAdminUser')->name('super_admin_user');
        Route::get('/profile-admin', 'adminProfile')->name('profile_admin');

        // users info modified by Super Admin 
        Route::post('/update-user-name-by-admin', 'updateUserNameByAdmin')->name('update_user_name_by_admin');
        Route::post('/update-user-phone-by-admin', 'updateUserPhoneByAdmin')->name('update_user_phone_by_admin');
        Route::post('/update-user-whatsapp-by-admin', 'updateUserWhatsappByAdmin')->name('update_user_whatsapp_by_admin');
        Route::post('/update-user-email-by-admin', 'updateUserEmailByAdmin')->name('update_user_email_by_admin');
        Route::post('/update-user-photo-by-admin', 'updateUserPhotoByAdmin')->name('update_user_photo_by_admin');
        Route::post('/update-user-password-by-admin', 'updateUserPasswordByAdmin')->name('update_user_password_by_admin');
        Route::post('/update-user-address-by-admin', 'updateUserAddressByAdmin')->name('update_user_address_by_admin');
        Route::post('/update-user-organization-by-admin', 'updateUserOrganizationByAdmin')->name('update_user_organization_by_admin');
        Route::post('/update-user-tender-area-by-admin', 'updateUserTenderAreaByAdmin')->name('update_user_tender_area_by_admin');
        Route::post('/update-user-account-validity-admin', 'updateUserAccountValidityByAdmin')->name('update_user_account_validity_by_admin');
        Route::delete('/delete-admin-by-admin/{id}', 'deleteAdminByAdmin')->name('delete_admin_by_admin');
    });

    // Only Super Admin can manage this
    Route::controller(CMSController::class)->prefix('/admin')->group(function () {
        Route::get('/add-package-info', 'addPackageInfo')->name('add_package_info');
        Route::post('/save-package-info', 'savePackageInfo')->name('save_package_info');
        Route::get('/manage-package-info', 'managePackageInfo')->name('manage_package_info');
        Route::get('/edit-package-info/{id}', 'editPackageInfo')->name('edit_package_info');
        Route::post('/update-package-info', 'updatePackageInfo')->name('update_package_info');


        Route::get('/add-tender-category', 'addTenderCategory')->name('add_tender_category');
        Route::post('/save-tender-category', 'saveTenderCategory')->name('save_tender_category');
        Route::get('/manage-tender-category', 'manageTenderCategory')->name('manage_tender_category');
        Route::get('/edit-tender-category/{id}', 'editTenderCategory')->name('edit_tender_category');
        Route::post('/update-tender-category', 'updateTenderCategory')->name('update_tender_category');
        Route::delete('/delete-tender-category', 'deleteTenderCategory')->name('delete_tender_category');


        Route::get('/add-tender-sub-category', 'addTenderSubCategory')->name('add_tender_sub_category');
        Route::post('/save-tender-sub-category', 'saveTenderSubCategory')->name('save_tender_sub_category');
        Route::get('/manage-tender-sub-category', 'manageTenderSubCategory')->name('manage_tender_sub_category');
        Route::get('/edit-tender-sub-category/{id}', 'editTenderSubCategory')->name('edit_tender_sub_category');
        Route::post('/update-tender-sub-category', 'updateTenderSubCategory')->name('update_tender_sub_category');
        Route::delete('/delete-tender-sub-category', 'deleteTenderSubCategory')->name('delete_tender_sub_category');


        Route::get('/add-tender', 'addTender')->name('add_tender');
        Route::post('/save-tender', 'saveTender')->name('save_tender');
        Route::get('/manage-tender', 'manageTender')->name('manage_tender');
        Route::get('/edit-tender/{id}', 'editTender')->name('edit_tender');
        Route::post('/update-tender', 'updateTender')->name('update_tender');
        Route::delete('/delete-tender', 'deleteTender')->name('delete_tender');


        Route::get('/add-homepage-content', 'addHomepageContent')->name('add_homepage_content');
        Route::post('/save-homepage-content', 'saveHomepageContent')->name('save_homepage_content');
        Route::get('/edit-homepage-content/{id}', 'editHomepageContent')->name('edit_homepage_content');
        Route::get('/manage-homepage-content', 'manageHomepageContent')->name('manage_homepage_content');
        Route::post('/update-homepage-content', 'updateHomepageContent')->name('update_homepage_content');


        Route::get('/add-helpline', 'addHelpline')->name('add_helpline');
        Route::post('/save-helpline', 'saveHelpline')->name('save_helpline');
        Route::get('/manage-helpline', 'manageHelpline')->name('manage_helpline');
        Route::get('/edit-helpline/{id}', 'editHelpline')->name('edit_helpline');
        Route::post('/update-helpline', 'updateHelpline')->name('update_helpline');
        Route::delete('/delete-helpline', 'deleteHelpline')->name('delete_helpline');


        Route::get('/add-important-notice', 'addImportantNotice')->name('add_important_notice');
        Route::post('/save-important-notice', 'saveImportantNotice')->name('save_important_notice');
        Route::get('/manage-important-notice', 'manageImportantNotice')->name('manage_important_notice');
        Route::get('/edit-important-notice/{id}', 'editImportantNotice')->name('edit_important_notice');
        Route::post('/update-important-notice', 'updateImportantNotice')->name('update_important_notice');
        Route::delete('/delete-important-notice', 'deleteImportantNotice')->name('delete_important_notice');
    });

    Route::controller(MemberController::class)->prefix('/member')->group(function () {
        // Create Member by super Admin
        Route::get('/add-member', 'addMember')->name('add_member');
        Route::post('/save-member', 'saveMember')->name('save_member');
        Route::get('/manage-member', 'manageMember')->name('manage_member');
        Route::get('/pending-member', 'pendingMember')->name('pending_member');
        Route::get('/verified-member', 'verifiedMember')->name('verified_member');
        Route::get('/edit-member/{id}', 'editMember')->name('edit_member');
        Route::get('/preview-member/{id}', 'previewMember')->name('preview_member');
        Route::delete('/delete-member/{id}', 'deleteMember')->name('delete_member');

        Route::get('/edit-member-payment-info/{id}', 'editMemberPaymentInfo')->name('edit_member_payment_info');
        Route::post('/update-member-payment-info', 'updateMemberPaymentInfo')->name('update_member_payment_info');
        Route::delete('/delete-member-payment-info', 'deleteMemberPaymentInfo')->name('delete_member_payment_info');

        // Member info modified by Super Admin 
        Route::post('/update-member-name-by-admin', 'updateMemberNameByAdmin')->name('update_member_name_by_admin');
        Route::post('/update-member-phone-by-admin', 'updateMemberPhoneByAdmin')->name('update_member_phone_by_admin');
        Route::post('/update-member-email-by-admin', 'updateMemberEmailByAdmin')->name('update_member_email_by_admin');
        Route::post('/update-member-photo-by-admin', 'updateMemberPhotoByAdmin')->name('update_member_photo_by_admin');
        Route::post('/update-member-password-by-admin', 'updateMemberPasswordByAdmin')->name('update_member_password_by_admin');
        Route::post('/update-member-address-by-admin', 'updateMemberAddressByAdmin')->name('update_member_address_by_admin');
        Route::post('/update-member-whatsapp-by-admin', 'updateMemberWhatsappByAdmin')->name('update_member_whatsapp_by_admin');
        Route::post('/update-member-organization-by-admin', 'updateMemberOrganizationByAdmin')->name('update_member_organization_by_admin');
        Route::delete('/delete-member-by-admin/{id}', 'deleteMemberByAdmin')->name('delete_member_by_admin');
    });
});

Route::controller(AdminController::class)->prefix('/admin')->group(function () {
    // Route::post('/update-user-name', 'updateUserName')->name('update_user_name');
    // Route::post('/update-user-phone', 'updateUserPhone')->name('update_user_phone');
    // Route::post('/update-user-email', 'updateUserEmail')->name('update_user_email');
    // Route::post('/update-user-photo', 'updateUserPhoto')->name('update_user_photo');
    // Route::post('/update-user-password', 'updateUserPassword')->name('update_user_password');
    Route::get('/profile-member', 'memberProfile')->name('profile_member');
});
