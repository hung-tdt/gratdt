<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomePageController;

use App\Http\Controllers\Admin\UploadController;

use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\AboutController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Customer\CommentController;
use App\Http\Controllers\Customer\ReviewController;

use App\Http\Controllers\PaymentController;

use App\Http\Controllers\MainController as ControllersMainController;
use App\Http\Services\UploadService;
use App\Models\User;

Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/users/login/store', [LoginController::class,'store']);
Route::get('admin/logout', [LoginController::class, 'logout'])->name('auths.logout');

Route::middleware(['auth:admin'])->group(function (){

    Route::prefix('admin')->group(function (){
        Route::get('main',[MainController::class, 'index'])->name('admin'); 

        Route::get('/get-sales-data', [MainController::class, 'getSalesData']);

        Route::get('/get-districts/{provinceId}', [AdminController::class, 'getDistricts']);
        Route::get('/get-wards/{districtId}', [AdminController::class, 'getWards']); 


        Route::post('upload/services',[UploadController::class,'store']);

        Route::prefix('manage-homepage')->group(function () {
            Route::get('showCatalog',[HomePageController::class,'showCatalog'])->name('homepages.showCatalog')->middleware('can:show.catalog');
            Route::post('/update-categories-status', [HomePageController::class, 'updateMultipleStatus'])->name('update-categories-status')->middleware('can:show.catalog');

            Route::get('showPostCategories',[HomePageController::class,'showPostCategories'])->name('homepages.showPostCategories')->middleware('can:show.postcategories');
            Route::post('/update-showPostCategories', [HomePageController::class, 'updateshowPostCategories'])->name('updateshowPostCategories')->middleware('can:show.postcategories');
        });

        Route::prefix('admins')->group(function () {
            Route::get('add',[AdminController::class,'create'])->name('admins.create')->middleware('can:admins.add');
            Route::post('add',[AdminController::class,'store'])->name('admins.store')->middleware('can:admins.add');
            Route::get('list',[AdminController::class,'index'])->name('admins.index')->middleware('can:admins.list');
            Route::get('edit/{id}',[AdminController::class,'edit'])->name('admins.edit')->middleware('can:admins.edit');
            Route::post('edit/{id}',[AdminController::class,'update'])->middleware('can:roles.edit');
            Route::delete('destroy',[AdminController::class,'destroy'])->name('admins.destroy')->middleware('can:admins.destroy'); 

            Route::get('/search', [AdminController::class, 'search'])->name('admins.search')->middleware('can:admins.list');
            
            Route::get('profile/{id}', [AdminController::class,'profile'])->name('admins.profile')->middleware('can:roles.edit');
            Route::post('profile/{id}', [AdminController::class,'editprofile'])->name('admins.editprofile')->middleware('can:roles.edit');
        });

        Route::prefix('roles')->group(function () {
            Route::get('add',[RoleController::class,'create'])->name('roles.create')->middleware('can:roles.add');
            Route::post('add',[RoleController::class,'store'])->name('roles.store')->middleware('can:roles.add');
            Route::get('list',[RoleController::class,'index'])->name('roles.index')->middleware('can:roles.list');
            Route::get('edit/{id}',[RoleController::class,'edit'])->name('roles.edit')->middleware('can:roles.edit');
            Route::post('edit/{id}',[RoleController::class,'update'])->name('roles.update')->middleware('can:roles.edit');
            Route::delete('destroy',[RoleController::class,'destroy'])->name('roles.destroy')->middleware('can:roles.destroy');        
        });
        
        //khach hang
        Route::prefix('customers')->group(function () {
            Route::get('add',[CustomerController::class,'create'])->name('customers.create')->middleware('can:customers.add');
            Route::post('add',[CustomerController::class,'store'])->name('customers.store')->middleware('can:customers.add');
            Route::get('list',[CustomerController::class,'index'])->name('customers.index')->middleware('can:customers.list');
            Route::get('edit/{id}',[CustomerController::class,'edit'])->name('customers.edit')->middleware('can:customers.edit');
            Route::post('edit/{id}',[CustomerController::class,'update'])->middleware('can:customers.edit');
            Route::delete('destroy',[CustomerController::class,'destroy'])->name('customers.destroy')->middleware('can:customers.destroy');     
            
            Route::get('/search', [CustomerController::class, 'search'])->name('customers.search')->middleware('can:customers.list');
        });

        Route::prefix('product_categories')->group(function () {
            Route::get('add',[ProductCategoryController::class,'add'])->name('product_categories.add')->middleware('can:product_categories.add');
            Route::post('add',[ProductCategoryController::class,'store'])->name('product_categories.store')->middleware('can:product_categories.add');
            Route::get('list',[ProductCategoryController::class,'list'])->name('product_categories.list')->middleware('can:product_categories.list');
            Route::get('edit/{productCategory}',[ProductCategoryController::class,'edit'])->name('product_categories.edit')->middleware('can:product_categories.edit');
            Route::post('edit/{productCategory}',[ProductCategoryController::class,'update'])->name('product_categories.update')->middleware('can:product_categories.edit');
            Route::delete('destroy',[ProductCategoryController::class,'destroy'])->name('product_categories.destroy')->middleware('can:product_categories.destroy');
        });
        
        Route::prefix('products')->group(function () {
            Route::get('add',[ProductController::class,'add'])->name('products.add')->middleware('can:products.add');
            Route::post('add',[ProductController::class,'store'])->name('products.store')->middleware('can:products.add');
            Route::get('list',[ProductController::class,'list'])->name('products.list')->middleware('can:products.list');
            Route::get('edit/{product}',[ProductController::class,'edit'])->name('products.edit')->middleware('can:products.edit');
            Route::post('edit/{product}',[ProductController::class,'update'])->name('products.update')->middleware('can:products.edit');
            Route::delete('destroy',[ProductController::class,'destroy'])->name('products.destroy')->middleware('can:products.destroy');

            Route::get('/product/{product}/add-stock', [ProductController::class, 'addStock'])->name('products.addStock')->middleware('can:stocks.add');
            Route::post('/product/{product}/store-stock', [ProductController::class, 'storeStock'])->name('products.storeStock')->middleware('can:stocks.add');

            Route::get('/product/{product}/stock-history', [ProductController::class, 'showStockHistory'])->name('products.stockHistory')->middleware('can:stocks.history.item');

            Route::get('/stock-history', [ProductController::class, 'showAllStockHistory'])->name('stock.history')->middleware('can:stocks.all.history');


            Route::get('/search', [ProductController::class, 'search'])->name('products.search')->middleware('can:products.list');

            Route::get('/out-of-stock', [ProductController::class, 'outOfStock'])->name('products.outOfStock');


        });

        Route::prefix('post_categories')->group(function () {
            Route::get('add',[PostCategoryController::class,'add'])->name('post_categories.add')->middleware('can:post_categories.add');
            Route::post('add',[PostCategoryController::class,'store'])->name('post_categories.store')->middleware('can:post_categories.add');
            Route::get('list',[PostCategoryController::class,'list'])->name('post_categories.list')->middleware('can:post_categories.list');
            Route::get('edit/{postCategory}',[PostCategoryController::class,'edit'])->name('post_categories.edit')->middleware('can:post_categories.edit');
            Route::post('edit/{postCategory}',[PostCategoryController::class,'update'])->name('post_categories.update')->middleware('can:post_categories.edit');
            Route::delete('destroy',[PostCategoryController::class,'destroy'])->name('post_categories.destroy')->middleware('can:post_categories.destroy');
        });

        Route::prefix('posts')->group(function () {
            Route::get('add',[PostController::class,'add'])->name('posts.add')->middleware('can:posts.add');
            Route::post('add',[PostController::class,'store'])->name('posts.store')->middleware('can:posts.add');
            Route::get('list',[PostController::class,'list'])->name('posts.list')->middleware('can:posts.list');
            Route::get('edit/{post}',[PostController::class,'edit'])->name('posts.edit')->middleware('can:posts.edit');
            Route::post('edit/{post}',[PostController::class,'update'])->name('posts.update')->middleware('can:posts.edit');
            Route::delete('destroy',[PostController::class,'destroy'])->name('posts.destroy')->middleware('can:posts.destroy');  

            Route::get('/search', [PostController::class, 'search'])->name('posts.search')->middleware('can:posts.list');
        });

        Route::prefix('coupons')->group(function () {
            Route::get('add',[CouponController::class,'add'])->name('coupons.add')->middleware('can:coupons.add');
            Route::post('add',[CouponController::class,'store'])->name('coupons.store')->middleware('can:coupons.add');
            Route::get('list',[CouponController::class,'list'])->name('coupons.list')->middleware('can:coupons.list');
            Route::get('edit/{coupon}',[CouponController::class,'edit'])->name('coupons.edit')->middleware('can:coupons.edit');
            Route::post('edit/{coupon}',[CouponController::class,'update'])->name('coupons.update')->middleware('can:coupons.edit');
            Route::delete('destroy',[CouponController::class,'destroy'])->name('coupons.destroy')->middleware('can:coupons.destroy');  

            Route::get('/search', [CouponController::class, 'search'])->name('posts.search')->middleware('can:coupons.list');
        });

        Route::prefix('sliders')->group(function () {
            Route::get('add',[SliderController::class,'add'])->name('sliders.add')->middleware('can:sliders.add');
            Route::post('add',[SliderController::class,'store'])->name('sliders.store')->middleware('can:sliders.add');
            Route::get('list',[SliderController::class,'list'])->name('sliders.list')->middleware('can:sliders.list');
            Route::get('edit/{slider}',[SliderController::class,'edit'])->name('sliders.edit')->middleware('can:sliders.edit');
            Route::post('edit/{slider}',[SliderController::class,'update'])->name('sliders.update')->middleware('can:sliders.edit');
            Route::delete('destroy',[SliderController::class,'destroy'])->name('sliders.destroy')->middleware('can:sliders.destroy');        
        });



        //đơn hàng
        Route::prefix('orders')->group(function () {
            Route::get('list', [App\Http\Controllers\Admin\OrderController::class, 'list'])->name('orders.list')->middleware('can:orders.received_cancel');
            Route::get('pending', [App\Http\Controllers\Admin\OrderController::class, 'pending'])->name('orders.pending')->middleware('can:orders.confirmer');
            Route::get('orderconfirmed', [App\Http\Controllers\Admin\OrderController::class, 'orderconfirmed'])->name('orders.orderconfirmed')->middleware('can:orders.packing');
            Route::get('shipping', [App\Http\Controllers\Admin\OrderController::class, 'shipping'])->name('orders.shipping')->middleware('can:orders.shiper');
            Route::get('received', [App\Http\Controllers\Admin\OrderController::class, 'received'])->name('orders.received')->middleware('can:orders.received_cancel');
            Route::get('cancelled', [App\Http\Controllers\Admin\OrderController::class, 'cancelled'])->name('orders.cancelled')->middleware('can:orders.received_cancel');

            Route::get('orderconfirmedDetail/{order}', [App\Http\Controllers\Admin\OrderController::class, 'orderconfirmedDetail'])->name('orders.orderconfirmedDetail')->middleware('can:orders.confirmer');
            Route::post('orders/{order}/updateOrderconfirmed', [App\Http\Controllers\Admin\OrderController::class, 'updateOrderconfirmed'])->name('orders.updateOrderconfirmed')->middleware('can:orders.confirmer');

            Route::get('shippingconfirmedDetail/{order}', [App\Http\Controllers\Admin\OrderController::class, 'shippingconfirmedDetail'])->name('orders.shippingconfirmedDetail')->middleware('can:orders.packing');
            Route::post('orders/{order}/updateshippingconfirmed', [App\Http\Controllers\Admin\OrderController::class, 'updateshippingconfirmed'])->name('orders.updateshippingconfirmed')->middleware('can:orders.packing');

            Route::get('detail/{order}', [App\Http\Controllers\Admin\OrderController::class, 'detail'])->name('orders.detail')->middleware('can:orders.shiper');

            Route::post('orders/{order}/receivedupdate', [App\Http\Controllers\Admin\OrderController::class, 'receivedupdate'])->name('orders.receivedupdate')->middleware('can:orders.shiper');
            Route::post('orders/{order}/canceledupdate', [App\Http\Controllers\Admin\OrderController::class, 'canceledupdate'])->name('orders.canceledupdate')->middleware('can:orders.shiper');

            Route::get('/search', [App\Http\Controllers\Admin\OrderController::class, 'search'])->name('orders.search')->middleware('can:orders.received_cancel');

            Route::get('/export-pdf', [App\Http\Controllers\Admin\OrderController::class, 'exportPdf'])->name('orders.exportPdf');

            Route::get('{order}/export-pdf', [App\Http\Controllers\Admin\OrderController::class, 'exportOrderPdf'])->name('orders.exportOrderPdf');
        });

    });
   
});



//login
Route::get('/login.html', [App\Http\Controllers\Customer\Auth\LoginController::class, 'login'])->name('customer.login');
Route::post('/login/store', [App\Http\Controllers\Customer\Auth\LoginController::class, 'loginStore']); 

//register
Route::get('/register.html', [App\Http\Controllers\Customer\Auth\LoginController::class, 'register'])->name('customer.register');
Route::post('/register/store', [App\Http\Controllers\Customer\Auth\LoginController::class, 'registerStore'])->name('customer.register.store');

//logout
Route::get('/customer/logout', [App\Http\Controllers\Customer\Auth\LoginController::class, 'logout'])->name('customer.logout');

//profile
Route::get('profile/{id}', [App\Http\Controllers\Customer\CustomerController::class,'profile'])->name('customer.profile');
Route::post('profile/{id}', [App\Http\Controllers\Customer\CustomerController::class,'editprofile'])->name('customer.editprofile');
Route::get('/get-districts/{provinceId}', [App\Http\Controllers\Customer\CustomerController::class, 'getDistricts']);
Route::get('/get-wards/{districtId}', [App\Http\Controllers\Customer\CustomerController::class, 'getWards']); 

Route::post('uploadcus/services',[App\Http\Controllers\Customer\UploadController::class,'store']);



Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/posts.html', [App\Http\Controllers\Customer\PostController::class,'showList']);
Route::get('danh-muc-bai-viet/{id}-{slug}.html', [App\Http\Controllers\Customer\PostCategoryController::class,'index']);
Route::get('post/{id}-{slug}.html', [App\Http\Controllers\Customer\PostController::class,'detail']);

Route::post('posts/{post}/comments', [CommentController::class, 'store']);


Route::post('/services/load-product', [HomeController::class,'loadProduct']);

Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\Customer\ProductCategoryController::class,'categoryProduct']);
Route::get('product/{id}-{slug}.html', [App\Http\Controllers\Customer\ProductController::class,'detail']);
Route::get('/shop.html', [App\Http\Controllers\Customer\ProductController::class,'showAllShop']);

Route::get('/search', [App\Http\Controllers\Customer\ProductController::class, 'search'])->name('products.search');
Route::get('/filter-by-price', [App\Http\Controllers\Customer\ProductController::class, 'filterByPrice'])->name('products.filterByPrice');


Route::get('/coupons', [App\Http\Controllers\Customer\CouponController::class, 'showAvailableCoupons'])->name('coupons.index');
Route::post('/coupons/save', [App\Http\Controllers\Customer\CouponController::class, 'saveCoupon'])->name('coupons.save');

Route::post('/coupons/apply', [App\Http\Controllers\Customer\CouponController::class, 'apply'])->name('coupons.apply');

    
Route::get('/about.html', function () {return view('customer.about');});
Route::get('/contact.html', function () {return view('Customer.contact');});



Route::post('/addcart', [CartController::class, 'addToCart'])->name('addcart');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');


Route::middleware(['web'])->group(function () {
    Route::post('/wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
});
Route::get('/wishlist/list', [WishlistController::class, 'list'])->name('wishlist.list');
Route::post('/wishlist/remove/{productId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');



Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('placeOrder');

Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order.history');
Route::get('/order-track/{order}', [OrderController::class, 'trackOrder'])->name('order.track');
Route::get('/orders/filter', [OrderController::class, 'filterOrders'])->name('customer.orders.filter');
Route::post('order/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('order.cancel');

Route::get('/orderdetail/{order_detail_id}/product/{product_id}/review', [ReviewController::class, 'showReviewForm'])->name('order.review');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment']);









