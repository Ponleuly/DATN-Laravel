<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController\CartController;
use App\Http\Controllers\UserController\HomeController;
use App\Http\Controllers\UserController\LikeController;
use App\Http\Controllers\AdminController\NewsController;
use App\Http\Controllers\AdminController\OrderController;
use App\Http\Controllers\AdminController\CouponController;
use App\Http\Controllers\UserController\ProductController;
use App\Http\Controllers\UserController\ProfileController;
use App\Http\Controllers\AdminController\ContactController;
use App\Http\Controllers\AdminController\SettingController;
use App\Http\Controllers\UserController\AuthUserController;
use App\Http\Controllers\AdminController\CustomerController;
use App\Http\Controllers\AdminController\DeliveryController;
use App\Http\Controllers\AdminController\AuthAdminController;
use App\Http\Controllers\AdminController\OrderStatusController;
use App\Http\Controllers\AdminController\ProductSizeController;
use App\Http\Controllers\AdminController\ProductgroupController;
use App\Http\Controllers\AdminController\AdminFrontendController;
use App\Http\Controllers\AdminController\ProductDetailController;
use App\Http\Controllers\AdminController\ProductCategoryController;
use App\Http\Controllers\AdminController\PaymentController;
use App\Http\Controllers\PaymentController\StripeController;
use Illuminate\Http\Request;
use App\Models\test;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
   return view('frontend.mainPages.home');
});
*/

Route::get('/index', function () {
   return view('index');
});
/*============= User Frontend route ==================*/
// *Using Route group to control route pages

Route::controller(AuthUserController::class)->group(function () {
   Route::get('login', 'userLogin')->name('login');
   Route::post('login', 'login')->name('login');
   Route::get('logout', 'userLogout')->name('logout')->middleware('authUser');

   Route::get('register', 'register')->name('register');
   Route::post('register', 'userRegister')->name('register');
});
//============== Profile Route with Middleware =====================//
Route::middleware('authUser')->group(function () {
   Route::controller(ProfileController::class)->group(function () {
      Route::get('profile', 'profile')->name('profile');
      Route::put('profile-update/{id}', 'profile_update')->name('profile-update');
      Route::get('change-password', 'change_password')->name('change-password');
      //Route::put('change-password/{id}', 'update_password')->name('change-password');
      Route::get('purchase-history', 'purchase_history')->name('purchase-history');
      Route::get('purchase-order-detail/{orderId}', 'purchase_order_detail')->name('purchase-order-detail');
      //Route::get('download-invoice/{id}', 'download_invoice')->name('download-invoice');
   });
});
Route::controller(ProfileController::class)->group(function () {
   Route::get('download-invoice/{id}', 'download_invoice')->name('download-invoice');
});
//==============Like Route with Middleware =====================//

Route::controller(LikeController::class)->group(function () {
   Route::get('like', 'like')->name('like')->middleware('authUser');
   Route::get('add-like/{product_id}/{user_id}', 'add_like')->name('add-like');
   Route::get('remove-like/{id}', 'remove_like')->name('remove-like');
   Route::get('remove-all-like/{num}', 'remove_all_like')->name('remove-all-like');
});
Route::controller(HomeController::class)->group(function () {
   Route::get('/', 'home')->name('home');
   Route::get('/home', 'home')->name('home');
   Route::post('/subscriber', 'subscriber_store')->name('subscriber');
   Route::get('/search-product', 'search_product')->name('search-product');
});
Route::controller(ProductController::class)->group(function () {
   Route::get('shop', 'shop')->name('shop');
   Route::get('product-{group}', 'product')->name('product-{group}');
   Route::get('product-detail/{code}', 'product_detail')->name('product-detail');
   Route::get('product-category/{category}', 'product_category')->name('product-category');
   Route::get('product-subcategory/{subcategory}', 'product_subcategory')->name('product-subcategory');
   Route::get('product-group-category/{group}/{category}', 'product_group_category')->name('product-group-category');
   Route::get('product-subcategory/{group}/{category}/{subcategory}', 'product_group_subcategory')->name('product-subcategory');
});
Route::controller(CartController::class)->group(function () {
   Route::get('cart', 'cart')->name('cart');
   Route::post('coupon-apply/{userId}', 'coupon_apply')->name('coupon-apply');
   Route::post('add-to-cart/{id}', 'add_to_cart')->name('add-to-cart');
   Route::put('update-cart/{id}', 'update_cart')->name('update-cart');
   Route::get('remove-from-cart/{id}', 'remove_from_cart')->name('remove-from-cart');
   Route::get('remove-all-cart/{num}', 'remove_all_cart')->name('remove-all-cart');
   //=================================================================//
   Route::group(['middleware' => 'prevent-back-history'], function () {
      Route::get('checkout/dis={discount}', 'checkout')->name('checkout');
      Route::post('place-order', 'place_order')->name('place-order');
      Route::get('order-completed/invoice={code}', 'order_completed')->name('order-completed');
      Route::get('order-canceled/invoice={code}', 'order_canceled')->name('order-canceled');
   });
});
/*================================================= End User Frontend route ====================================================*/


/*================================================== Admin Frontend route =========================================================*/

Route::controller(AuthAdminController::class)->group(function () {
   Route::get('admin', 'adminLogin')->name('admin');
   Route::post('admin/login', 'login')->name('login');
   Route::get('admin/logout', 'adminLogout')->name('logout');
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(AdminFrontendController::class)->group(function () {
      Route::get('/dashboard', 'dashboard')->name('dashboard');
      Route::get('/profile/{id}', 'profile')->name('profile');
      Route::put('/profile/{id}', 'update_profile')->name('profile');
      Route::get('/change-password/{id}', 'change_password')->name('change-password');
      Route::put('/change-password/{id}', 'update_password')->name('change-password');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(ProductGroupController::class)->group(function () {
      Route::get('/product-group-list', 'product_group_list')->name('product-group-list');
      Route::get('/product-group-add', 'product_group_add')->name('product-group-add');
      Route::post('/product-group-add', 'product_group_store')->name('product-group-add');
      Route::get('/product-group-edit/{id}', 'product_group_edit')->name('product-group-edit');
      Route::put('/product-group-edit/{id}', 'product_group_update');
      Route::get('/product-group-delete/{id}', 'product_group_delete');
      Route::get('/product-group-search', 'product_group_search')->name('product-group-search');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(ProductCategoryController::class)->group(function () {
      Route::get('/product-category-list', 'product_category_list')->name('product-category-list');
      Route::get('/product-category-sub-list', 'product_subcategory_list')->name('product-category-sub-list');
      Route::get('/product-category-view/{id}', 'product_category_view')->name('product-category-view');
      Route::get('/product-category-add', 'product_category_add')->name('product-category-add');
      Route::post('/product-category-add', 'product_category_store')->name('product-category-add');
      Route::get('/product-category-edit/{id}', 'product_category_edit')->name('product-category-edit');
      Route::put('/product-category-edit/{id}', 'product_category_update');
      Route::get('/product-category-delete/{id}', 'product_category_delete');
      Route::get('/product-category-search', 'product_category_search')->name('product-category-search');
      Route::get('/product-category-sub-search', 'product_subcategory_search')->name('product-category-sub-search');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(ProductSizeController::class)->group(function () {
      Route::get('/product-size-list', 'product_size_list')->name('product-size-list');
      Route::get('/product-size-add', 'product_size_add')->name('product-size-add');
      Route::post('/product-size-add', 'product_size_store')->name('product-size-add');
      Route::get('/product-size-edit/{id}', 'product_size_edit')->name('product-size-edit');
      Route::put('/product-size-edit/{id}', 'product_size_update');
      Route::get('/product-size-delete/{id}', 'product_size_delete');
      Route::get('/product-size-search', 'product_size_search')->name('product-size-search');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(ProductDetailController::class)->group(function () {
      Route::get('/product-detail-list/show={res}/by-{title}={sort}', 'product_detail_list')->name('product-detail-list');
      Route::get('/product-detail-view/{code}', 'product_detail_view')->name('product-detail-view');
      Route::get('/product-detail-add', 'product_detail_add')->name('product-detail-add');
      Route::post('/product-detail-add', 'product_detail_store')->name('product-detail-add');
      Route::get('/product-detail-edit/{id}', 'product_detail_edit')->name('product-detail-edit');
      Route::put('/product-detail-edit/{id}', 'product_detail_update');
      Route::get('/product-detail-delete/{id}', 'product_detail_delete');
      Route::get('/product-detail-status/{product_id}/{status_id}', 'product_detail_status')
         ->name('product-detail-status');
      Route::get('product-search/show={res}/by-{title}={sort}', 'product_search')->name('product-search');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(DeliveryController::class)->group(function () {
      Route::get('/delivery-list', 'delivery_list')->name('delivery-list');
      Route::get('/delivery-add', 'delivery_add')->name('delivery-add');
      Route::post('/delivery-add', 'delivery_store')->name('delivery-add');
      Route::get('/delivery-edit/{id}', 'delivery_edit')->name('delivery-edit');
      Route::put('/delivery-edit/{id}', 'delivery_update');
      Route::get('/delivery-delete/{id}', 'delivery_delete');
      Route::get('/delivery-search', 'delivery_search')->name('delivery-search');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(OrderController::class)->group(function () {
      //Route::get('/order-list/show={res}', 'order_list_page')->name('order-list');
      Route::get('/order-list/show={res}/by-{title}={sort}', 'order_list_page')->name('order-list');
      Route::get('/order-details/{id}', 'order_details')->name('order-details');
      Route::get('/order-invoice/{id}', 'order_invoice')->name('order-invoice');
      Route::get('/download-invoice/{id}', 'download_invoice')->name('download-invoice');
      Route::get('/order-status-action/{order_id}/{status_name}', 'order_status_action')->name('order-status-action');
      Route::get('/order-search/show={res}/by-{title}={sort}', 'order_search')->name('order-search');
      Route::get('/order-delete/{id}', 'order_delete')->name('order-delete');
      Route::put('/order-customer-edit/{id}', 'order_customer_edit')->name('order-customer-edit');
   });
});
/*
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(OrderStatusController::class)->group(function () {
      Route::get('order-status-list', 'order_status_list')->name('order-status-list');
      Route::get('order-status-add', 'order_status_add')->name('order-status-add');
      Route::post('order-status-add', 'order_status_store')->name('order-status-add');
      Route::get('order-status-edit/{id}', 'order_status_edit')->name('order-status-edit');
      Route::put('order-status-edit/{id}', 'order_status_update')->name('order-status-edit');
      Route::get('order-status-delete/{id}', 'order_status_delete')->name('order-status-delete');
      Route::get('/order-status-search', 'order_status_search')->name('order-status-search');
   });
});
*/
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(CustomerController::class)->group(function () {
      Route::get('/customer-list', 'customer_list')->name('customer-list');
      Route::get('/customer-delete/{id}', 'customer_delete')->name('customer-delete');
      Route::get('/customer-edit/{id}', 'customer_edit')->name('customer-edit');
      Route::put('/customer-edit/{id}', 'customer_update')->name('customer-edit');
      Route::get('/customer-member-list', 'member_list')->name('customer-member-list');
      Route::get('/customer-member-delete/{id}', 'member_delete')->name('customer-member-delete');
      Route::get('/customer-subscriber-list', 'subscriber_list')->name('customer-subscriber-list');
      Route::get('/customer-subscriber-delete/{id}', 'subscriber_delete')->name('customer-subscriber-delete');
      Route::get('/customer-search', 'customer_search')->name('customer-search');
      Route::get('/customer-member-search', 'member_search')->name('customer-member-search');
      Route::get('/customer-subscriber-search', 'subscriber_search')->name('customer-subscriber-search');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(CouponController::class)->group(function () {
      Route::get('/coupon-list', 'coupon_list')->name('coupon-list');
      Route::get('/coupon-view/{id}', 'coupon_view')->name('coupon-view');
      Route::get('/coupon-add', 'coupon_add')->name('coupon-add');
      Route::post('/coupon-add', 'coupon_store')->name('coupon-add');
      Route::get('/coupon-edit/{id}', 'coupon_edit')->name('coupon-edit');
      Route::put('/coupon-edit/{id}', 'coupon_update');
      Route::get('/coupon-delete/{id}', 'coupon_delete');
      Route::get('/coupon-search', 'coupon_search')->name('coupon-search');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(SettingController::class)->group(function () {
      Route::get('/general-setting', 'general_setting')->name('general-setting');
      Route::get('/general-setting-edit', 'general_setting_edit')->name('general-setting-edit');
      Route::put('/general-setting-edit', 'general_setting_update')->name('general-setting-edit');
      Route::get('/general-layout', 'general_layout')->name('general-layout');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(ContactController::class)->group(function () {
      Route::get('/contact-list', 'contact_list')->name('contact-list');
      Route::get('/contact-add', 'contact_add')->name('contact-add');
      Route::post('/contact-add', 'contact_store')->name('contact-add');
      Route::get('/contact-edit/{id}', 'contact_edit')->name('contact-edit');
      Route::put('/contact-edit/{id}', 'contact_update');
      Route::get('/contact-delete/{id}', 'contact_delete');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(NewsController::class)->group(function () {
      Route::get('/news-list', 'news_list')->name('news-list');
      Route::get('/news-view/{id}', 'news_view')->name('news-view');
      Route::get('/news-add', 'news_add')->name('news-add');
      Route::post('/news-add', 'news_store')->name('news-add');
      Route::get('/news-edit/{id}', 'news_edit')->name('news-edit');
      Route::put('/news-edit/{id}', 'news_update');
      Route::get('/news-delete/{id}', 'news_delete');
      Route::get('/news-search', 'news_search')->name('news-search');
   });
});
Route::prefix('admin')->middleware('authAdmin')->group(function () {
   Route::controller(PaymentController::class)->group(function () {
      Route::get('/payment-list', 'payment_list')->name('payment-list');
      Route::get('/payment-view/{id}', 'payment_view')->name('payment-view');
      Route::get('/payment-add', 'payment_add')->name('payment-add');
      Route::post('/payment-add', 'payment_store')->name('payment-add');
      Route::get('/payment-edit/{id}', 'payment_edit')->name('payment-edit');
      Route::put('/payment-edit/{id}', 'payment_update');
      Route::get('/payment-delete/{id}', 'payment_delete');
      Route::get('/payment-search', 'payment_search')->name('payment-search');
   });
});
Route::get('payment/invoicecode={code}/totalpaid={total}', [StripeController::class, 'paymentForm'])->name('payment');
//Route::post('payment/invoicecode={code}/totalpaid={total}', [StripeController::class, 'payment'])->name('payment');
Route::post('webhook', [StripeController::class, 'paymentInfo'])->name('webhook');

/*
Route::post('webhook', function (Request $request) {
   if ($request->type === 'charge.succeeded') {
      test::create([
         'amount' => $request->data['object']['amount'],
      ]);
   }
})->name('webhook');
*/