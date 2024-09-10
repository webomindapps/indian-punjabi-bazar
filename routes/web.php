<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CMS\BannerController;
use App\Http\Controllers\Admin\CMS\EmailTemplateController;
use App\Http\Controllers\Admin\CMS\PageController;
use App\Http\Controllers\Admin\CMS\SliderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DeliveryCityController;
use App\Http\Controllers\Admin\FlavourController;
use App\Http\Controllers\Admin\HomeSettingController;
use App\Http\Controllers\Admin\MonthlyFlyerController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductformController;
use App\Http\Controllers\Admin\ProductRequestController;
use App\Http\Controllers\Admin\ProductsourceController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\CustomerPasswordResetController;
use App\Http\Controllers\Frontend\BookTimeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;
use App\Http\Controllers\Frontend\EnquiryController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common routes
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('cart-items', [CartController::class, 'cartItems'])->name('get-cart-items');
Route::post('serarch-products', [ShopController::class, 'searchProduct'])->name('search.products');
Route::get('page/{page}', [ShopController::class, 'pageDetails'])->name('page.view');
Route::get('contact-us', [EnquiryController::class, 'create'])->name('contact.us');
Route::post('contact-us', [EnquiryController::class, 'store']);
Route::get('product-request', [ProductRequestController::class, 'create'])->name('product.request');
Route::post('product-request', [ProductRequestController::class, 'store']);
Route::view('locations', 'frontend.pages.store-location')->name('location');
Route::view('location/details', 'frontend.pages.location-details')->name('location.details');
Route::get('all-brands', [ShopController::class, 'allBrands'])->name('all.brands');
Route::get('all-categories', [ShopController::class, 'allCategories'])->name('all.categories');
Route::get('all-health-goals-and-concerns', [ShopController::class, 'allHealths'])->name('all.healths');

// news letter
Route::post('new-subscription', [NewsLetterController::class, 'subscription'])->name('new.subscription');

// career
Route::get('career', [CareerController::class, 'create'])->name('career');
Route::post('career', [CareerController::class, 'store']);

Route::get('auth/google', [FrontendCustomerController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [FrontendCustomerController::class, 'handleGoogleCallback'])->name('google.callback');

// reviews
Route::post('review', [ReviewController::class, 'store'])->name('store.review');


Route::middleware('guest:customer')->group(function () {
    Route::get('customer/login', [FrontendCustomerController::class, 'login'])->name('customer.login');
    Route::post('customer/login', [FrontendCustomerController::class, 'authenticate']);
    Route::get('customer/forget-password', [CustomerPasswordResetController::class, 'forgetView'])->name('customer.forget.password');
    Route::post('customer/forget-password', [CustomerPasswordResetController::class, 'forgetMail']);

    Route::get('customer/{token}/password-reset', [CustomerPasswordResetController::class, 'resetView'])->name('customer.reset.view');
    Route::post('customer/password-reset', [CustomerPasswordResetController::class, 'resetPassword'])->name('customer.password.reset');
});
Route::get('customer/register', [FrontendCustomerController::class, 'register'])->name('customer.register');
Route::post('customer/register', [FrontendCustomerController::class, 'store']);
Route::get('customer/email-verify', [FrontendCustomerController::class, 'verify'])->name('customer.verify');
Route::post('customer/email-verify', [FrontendCustomerController::class, 'sendVerifyMail']);
Route::get('customer/email-verified', [FrontendCustomerController::class, 'verifyEmail'])->name('customer.email.verified');

Route::get('cart', [CartController::class, 'cartView'])->name('cart');
Route::post('add/cart', [CartController::class, 'store'])->name('add-to-cart');
Route::get('add/cart/{id}', [CartController::class, 'storeQty1']);
Route::get('cart-item/delete/{id}', [CartController::class, 'destroy'])->name('delete-cart');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart-update');
Route::post('/coupon/apply', [CartController::class, 'applyCoupon'])->name('coupon.apply');
Route::get('/coupon/{id}/remove', [CartController::class, 'removeCoupon'])->name('coupon.remove');

// customer  data
Route::group(['middleware' => 'auth:customer'], function () {
    Route::get('customer/logout', [FrontendCustomerController::class, 'logout'])->name('customer.logout');
    Route::group(['middleware' => 'customer.verified'], function () {
        Route::get('customer/profile', [FrontendCustomerController::class, 'profile'])->name('customer.profile');
        Route::post('customer/reset/password', [FrontendCustomerController::class, 'reset'])->name('customer.reset.password');
        Route::post('customer/update/profile', [FrontendCustomerController::class, 'update'])->name('customer.update.profile');
        Route::get('customer/address', [FrontendCustomerController::class, 'address'])->name('customer.address');
        Route::get('customer/address/add', [FrontendCustomerController::class, 'addAddress'])->name('create.address');
        Route::post('customer/address/add', [FrontendCustomerController::class, 'storeAddress']);
        Route::get('customer/orders', [FrontendCustomerController::class, 'orders'])->name('customer.orders');
        Route::get('customer/order/{id}/details', [FrontendCustomerController::class, 'orderDetails'])->name('customer.order.details');

        Route::get('customer/wishlist', [CheckoutController::class, 'wishlist'])->name('customer.wishlist');
        Route::get('add/{id}/wishlist', [CheckoutController::class, 'addToWishlist'])->name('add-to-wishlist');
        Route::get('wishlist/{id}/remove', [CheckoutController::class, 'removeFromWishlist'])->name('wishlist.remove');
        // checkout
        Route::get('checkout', [ShopController::class, 'checkout'])->name('checkout');

        // Order
        Route::get('create/order/{address_id}/{order_no}', [CheckoutController::class, 'createOrder'])->name('order');
        Route::get('booking/{id}/success', [CheckoutController::class, 'success'])->name('booking.success');

        // book a time
        Route::get('book-a-time', [BookTimeController::class, 'index'])->name('book-time');
        Route::post('/update-delivery-locations', [CartController::class, 'deliveryLocation']);

        // payment
        Route::post('/payment/initiate', [PaymentController::class, 'showPaymentForm'])->name('payment.initiate');
        Route::get('/payment-response', [PaymentController::class, 'paymentResponse'])->name('payment.response');
    });
});


Route::middleware('guest:admin')->group(function () {
    Route::view('admin/login', 'admin/auth/login')->name('login');
    Route::post('admin/login', [AuthController::class, 'store'])->name('admin.login.store');
});

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

        // category
        Route::get('categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('category/create', [CategoryController::class, 'store']);
        Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('category/{id}/edit', [CategoryController::class, 'update']);
        Route::get('category/{id}/delete', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::post('categories/delete_selected', [CategoryController::class, 'deleteSelected']);
        Route::post('categories/statusChng_selected', [CategoryController::class, 'bulkStsChng']);
        Route::get('category/export', [CategoryController::class, 'export'])->name('category.export');

        // Products
        Route::get('products', [ProductController::class, 'index'])->name('products');
        Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('product/create', [ProductController::class, 'store']);
        Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('product/{id}/edit', [ProductController::class, 'update']);
        Route::get('product/{id}/delete', [ProductController::class, 'destroy'])->name('product.delete');
        Route::post('products/delete_selected', [ProductController::class, 'deleteSelected']);
        Route::post('products/statusChng_selected', [ProductController::class, 'bulkStsChng']);
        Route::get('products/mass_category_update', [ProductController::class, 'massCategoryUpdate'])->name('mass_category_update');
        Route::post('products/mass_category_update', [ProductController::class, 'bulkCategory']);
        Route::post('products/update_name', [ProductController::class, 'updateName']);
        Route::post('products/update_price', [ProductController::class, 'updatePrice']);
        Route::get('product/export', [ProductController::class, 'export'])->name('product.export');

        // product bulk upload
        Route::get('producs/bulk-upload', [ProductController::class, 'bulkUploadView'])->name('products.bulk.upload');
        Route::post('producs/bulk-upload', [ProductController::class, 'bulkUpload']);

        // brands
        Route::get('brands', [BrandController::class, 'index'])->name('brands');
        Route::get('brand/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('brand/create', [BrandController::class, 'store']);
        Route::get('brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('brand/{id}/edit', [BrandController::class, 'update']);
        Route::get('brand/{id}/delete', [BrandController::class, 'destroy'])->name('brand.delete');

        // Variants
        Route::get('variants', [VariantController::class, 'index'])->name('variants');
        Route::post('variant', [VariantController::class, 'store'])->name('variant.store');
        Route::get('variant-value', [VariantController::class, 'variantValue'])->name('variant.value.index');
        Route::post('variant-value', [VariantController::class, 'variantValueStore'])->name('variant.value.store');
        Route::get('product_variante/{id}/delete', [ProductController::class, 'varianteDelete'])->name('variante.delete');
        Route::get('product_image/{id}/delete', [ProductController::class, 'imageDelete'])->name('product.image.delete');

        // customers
        Route::get('customers', [CustomerController::class, 'index'])->name('customers');
        Route::get('customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('customer/{id}/edit', [CustomerController::class, 'update']);
        Route::get('customer/{id}/delete', [CustomerController::class, 'destroy'])->name('customer.delete');

        // orders
        Route::get('orders', [OrderController::class, 'index'])->name('orders');
        Route::get('order/{id}/details', [OrderController::class, 'details'])->name('order.details');
        Route::post('order/delivery-date/{id}', [OrderController::class, 'deliveryUpdate'])->name('orders.updatedelivery');
        Route::get('order/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
        Route::get('order/invoices', [OrderController::class, 'getInvoices'])->name('order.invoices');
        Route::get('order/shipments', [OrderController::class, 'getShipments'])->name('order.shipments');
        Route::get('order/refunds', [OrderController::class, 'getRefunds'])->name('order.refunds');
        Route::post('order/export', [OrderController::class, 'export'])->name('order.export');

        // Coupon
        Route::get('coupons', [CouponController::class, 'index'])->name('coupons');
        Route::get('coupon/create', [CouponController::class, 'create'])->name('coupon.create');
        Route::post('coupon/create', [CouponController::class, 'store']);
        Route::get('coupon/{id}/edit', [CouponController::class, 'edit'])->name('coupon.edit');
        Route::post('coupon/{id}/edit', [CouponController::class, 'update']);
        Route::get('coupon/{id}/delete', [CouponController::class, 'destroy'])->name('coupon.delete');

        // banners
        Route::get('banners', [BannerController::class, 'index'])->name('banners');
        Route::get('banner/create', [BannerController::class, 'create'])->name('banner.create');
        Route::post('banner/create', [BannerController::class, 'store']);
        Route::get('banner/{id}/destroy', [BannerController::class, 'destroy'])->name('banner.destroy');

        // tax
        Route::get('taxes', [TaxController::class, 'index'])->name('taxes');
        Route::get('tax/create', [TaxController::class, 'create'])->name('tax.create');
        Route::post('tax/create', [TaxController::class, 'store']);
        Route::get('tax/{id}/edit', [TaxController::class, 'edit'])->name('tax.edit');
        Route::post('tax/{id}/edit', [TaxController::class, 'update']);
        Route::get('tax/{id}/delete', [TaxController::class, 'destroy'])->name('tax.delete');
        Route::post('taxes/delete_selected', [TaxController::class, 'deleteSelected']);
        Route::post('taxes/statusChng_selected', [TaxController::class, 'bulkStsChng']);

        // Sliders
        Route::get('sliders', [SliderController::class, 'index'])->name('sliders');
        Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('slider/create', [SliderController::class, 'store']);
        Route::get('slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('slider/{id}/edit', [SliderController::class, 'update']);
        Route::get('slider/{id}/delete', [SliderController::class, 'destroy'])->name('slider.delete');

        // Pages
        Route::get('pages', [PageController::class, 'index'])->name('pages');
        Route::get('page/create', [PageController::class, 'create'])->name('page.create');
        Route::post('page/create', [PageController::class, 'store']);
        Route::get('page/{id}/edit', [PageController::class, 'edit'])->name('page.edit');
        Route::post('page/{id}/edit', [PageController::class, 'update']);
        Route::get('page/{id}/delete', [PageController::class, 'destroy'])->name('page.delete');

        // Email templates
        Route::get('email-templates', [EmailTemplateController::class, 'index'])->name('email.templates');
        Route::get('email-template/create', [EmailTemplateController::class, 'create'])->name('email-template.create');
        Route::post('email-template/create', [EmailTemplateController::class, 'store']);
        Route::get('email-template/{id}/edit', [EmailTemplateController::class, 'edit'])->name('email-template.edit');
        Route::post('email-template/{id}/edit', [EmailTemplateController::class, 'update']);
        Route::get('email-template/{id}/delete', [EmailTemplateController::class, 'destroy'])->name('email-template.delete');

        // Newsletter
        Route::get('newsletters', [NewsLetterController::class, 'index'])->name('newsletters');
        Route::get('subscriber/{id}/edit', [NewsLetterController::class, 'edit'])->name('subscriber.edit');
        Route::post('subscriber/{id}/edit', [NewsLetterController::class, 'update']);
        Route::get('subscriber/{id}/delete', [NewsLetterController::class, 'destroy'])->name('subscriber.delete');
        Route::get('subscriber/export', [NewsLetterController::class, 'export'])->name('subscriber.export');

        // monthly flyer
        Route::get('monthly-flyer', [MonthlyFlyerController::class, 'index'])->name('monthlyflyer');
        Route::post('monthly-flyer', [MonthlyFlyerController::class, 'store']);

        // career
        Route::get('career-applications', [CareerController::class, 'index'])->name('applicants');
        Route::get('career-application/{id}/details', [CareerController::class, 'show'])->name('applicant.details');

        // reviews
        Route::get('reviews', [ReviewController::class, 'index'])->name('reviews');
        Route::get('review/{id}/details', [ReviewController::class, 'edit'])->name('review.edit');
        Route::post('review/{id}/details', [ReviewController::class, 'update']);
        Route::get('review/{id}/delete', [ReviewController::class, 'destroy'])->name('review.delete');
        Route::post('reviews/delete_selected', [ReviewController::class, 'deleteSelected']);
        Route::post('reviews/statusChng_selected', [ReviewController::class, 'bulkStsChng']);

        // homesetting
        Route::get('home-setting', [HomeSettingController::class, 'index'])->name('home.setting');
        Route::post('home-setting', [HomeSettingController::class, 'update']);

        // admins
        Route::get('users', [AdminController::class, 'index'])->name('admin.users');
        Route::get('user/add', [AdminController::class, 'create'])->name('admin.user.add');
        Route::post('user/add', [AdminController::class, 'store']);
        Route::get('user/{id}/edit', [AdminController::class, 'edit'])->name('user.edit');
        Route::post('user/{id}/edit', [AdminController::class, 'update']);
        Route::get('user/{id}/delete', [AdminController::class, 'destroy'])->name('user.delete');

        // Invoice create
        Route::get('invoice/{id}/create', [OrderController::class, 'generateInvoice'])->name('invoice.generate');
        Route::get('invoice/{id}/details', [OrderController::class, 'invoiceDetails'])->name('invoice.details');
        Route::get('invoice/{id}/print', [OrderController::class, 'generatePdf'])->name('invoice.print');
        Route::get('shipments/{id}/create', [OrderController::class, 'shipmentCreate'])->name('shipment.create');
        Route::post('shipments/{id}/create', [OrderController::class, 'shipmentStore']);
        Route::get('refund/{id}/create', [OrderController::class, 'refund'])->name('refund.create');
        Route::post('refund/{id}/create', [OrderController::class, 'refundStore']);

        // Delivery cities
        Route::get('delivery/cities', [DeliveryCityController::class, 'index'])->name('delivery.cities');
        Route::get('delivery/city/create', [DeliveryCityController::class, 'create'])->name('delivery.city.create');
        Route::post('delivery/city/create', [DeliveryCityController::class, 'store']);
        Route::get('delivery/city/{id}/edit', [DeliveryCityController::class, 'edit'])->name('delivery.city.edit');
        Route::post('delivery/city/{id}/edit', [DeliveryCityController::class, 'update']);
        Route::get('delivery/city/{id}/delete', [DeliveryCityController::class, 'destroy'])->name('delivery.city.delete');
        Route::post('delivery/cities/delete_selected', [DeliveryCityController::class, 'deleteSelected']);
        Route::post('delivery/cities/statusChng_selected', [DeliveryCityController::class, 'bulkStsChng']);

        // Units
        Route::get('units', [UnitController::class, 'index'])->name('units');
        Route::get('unit/create', [UnitController::class, 'create'])->name('unit.create');
        Route::post('unit/create', [UnitController::class, 'store']);
        Route::get('unit/{id}/edit', [UnitController::class, 'edit'])->name('unit.edit');
        Route::post('unit/{id}/edit', [UnitController::class, 'update']);
        Route::get('unit/{id}/delete', [UnitController::class, 'destroy'])->name('unit.delete');

        // enquiry
        Route::get('enquiries', [EnquiryController::class, 'index'])->name('enquiries');
        Route::get('enquiry/{id}/delete', [EnquiryController::class, 'destroy'])->name('enquiry.delete');

        // product requests
        Route::get('product-request', [ProductRequestController::class, 'index'])->name('product.requests');
        Route::get('product-request/{id}/show', [ProductRequestController::class, 'show'])->name('product.request.show');
        Route::get('product-request/{id}/delete', [ProductRequestController::class, 'destroy'])->name('product.request.delete');

        // Flavour
        Route::get('flavours', [FlavourController::class, 'index'])->name('flavours');
        Route::get('flavour/create', [FlavourController::class, 'create'])->name('flavour.create');
        Route::post('flavour/create', [FlavourController::class, 'store']);
        Route::get('flavour/{id}/edit', [FlavourController::class, 'edit'])->name('flavour.edit');
        Route::post('flavour/{id}/edit', [FlavourController::class, 'update']);
        Route::get('flavour/{id}/delete', [FlavourController::class, 'destroy'])->name('flavour.delete');

        // Source
        Route::get('productsources', [ProductsourceController::class, 'index'])->name('productsources');
        Route::get('productsource/create', [ProductsourceController::class, 'create'])->name('productsource.create');
        Route::post('productsource/create', [ProductsourceController::class, 'store']);
        Route::get('productsource/{id}/edit', [ProductsourceController::class, 'edit'])->name('productsource.edit');
        Route::post('productsource/{id}/edit', [ProductsourceController::class, 'update']);
        Route::get('productsource/{id}/delete', [ProductsourceController::class, 'destroy'])->name('productsource.delete');

        // Form
        Route::get('productforms', [ProductformController::class, 'index'])->name('productforms');
        Route::get('productform/create', [ProductformController::class, 'create'])->name('productform.create');
        Route::post('productform/create', [ProductformController::class, 'store']);
        Route::get('productform/{id}/edit', [ProductformController::class, 'edit'])->name('productform.edit');
        Route::post('productform/{id}/edit', [ProductformController::class, 'update']);
        Route::get('productform/{id}/delete', [ProductformController::class, 'destroy'])->name('productform.delete');
        Route::post('producs/bulk-upload-import', [ProductController::class, 'bulkUpdateImport'])->name('bulk.update.import');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::any('{any}', [ShopController::class, 'productByCategory'])->name('productByCategory');
