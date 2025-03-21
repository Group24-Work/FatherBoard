
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Models\CustomerInfo;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BasketController;
use App\Models\ContactForm;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReturnedOrderController;

Route::get('/login', [AuthController::class, 'giveLogin'])->name("login");
Route::get('/',function(){

    return view('home');
});
//review side back-end
Route::post('/review',[ReviewController::class,'store'])->name('submitReview');
Route::get('/review', [ReviewController::class, 'create'])->name('createReview');
Route::get('/product/{id}/review', [ReviewController::class,'showReview'])->name('review.show');

Route::post("/add/review", [ReviewController::class, 'add']);

// Login / Authentication System
Route::post('/submit-review',[ReviewController::class,'store'])->name('submitReview');
Route::post('/_login', [AuthController::class, 'form_login']);
Route::post('/_explicit_login', [AuthController::class, "explicit_login"]);
Route::post("/_explicit_register", [AuthController::class, "explicit_register"]);
Route::post('/_register', [AuthController::class, "form_register"]);
Route::get('logout', action: [AuthController::class, "logOut"]);

Route::get("/register",[AuthController::class,"giveRegister"])->name("register");

Route::get("/forgot", [AuthController::class, "giveForgotCredentials"])->name("forgot");

Route::post("/forgot", [AuthController::class, "forgotPassword"]);

Route::get("/reset/{id}", [AuthController::class, "giveReset"]);

Route::post("/reset", [AuthController::class, "resetPassword"]);
// Home System
Route::get('/home', [HomeController::class, "giveHome"])->name("home");



// Handles products
Route::get('/product/{id}', action: [ProductController::class, "show"]);
Route::get('/products', [ProductController::class, "index"])->name("products");
Route::post('/products', [ProductController::class, "indexSpecific"]);

Route::post("/create/product", function ()
{

});




// Settings-related

Route::get('/settings', [SettingController::class, 'pageSettings'])->name("settings");
Route::post('/get/personal', action: [SettingController::class, "showPersonal"]);
Route::post('/update/personal', [SettingController::class, 'updatePersonal']);

Route::get("/orders/{id}", [SettingController::class, "showOrder"])->name('show.order');
// Terms

Route::get("/terms", function()
{
    return view("terms");
})->name("terms");


// Handles address
Route::post('/get/address', [SettingController::class, "showAddress"]);
Route::post('/add/address', [SettingController::class, "form_addAddress"]);
Route::post("/delete/address", [SettingController::class, "form_removeAddress"]);

// Contact Form

Route::post("/add/message", [ContactFormController::class, "form_message"]);
Route::get("/contact", [ContactFormController::class, "giveContact"])->name("contact");

// About Us

Route::get('/about', function()
{
    return view('about');
});


Route::get('/questionnaire', function()
{
    return view('questionnaire');
});

Route::get('/questionnaire', [TagController::class, 'questionnaire']);

//basket side back-end
Route::get('/basket',[BasketController::class,'index'])->name('basketIndex');
Route::post('/basket/add/',[BasketController::class,'add'])->name('basketAdd');

Route::post('/basket/remove',[BasketController::class,'remove'])->name('basketRemove');
Route::post('/basket/update',[BasketController::class,'update'])->name('basketUpdate');
Route::get('/basket/checkout',[BasketController::class,'checkout'])->name('basketCheckout');

//checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout',[CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class,'success'])->name('checkout_success');

//Admin

// Interactive Admin
Route::get('/admin/products', [AdminProductController::class, "index"])->name('adminIndex');
Route::get('/admin/product/create', [AdminProductController::class, "create"])->name('create');
Route::get('/admin/product/{id}', action: [AdminProductController::class, "show"])->name('edit');
Route::delete('/admin/products{id}', action: [AdminProductController::class, "destroy"])->name('delete');
Route::post('/admin/product/create', [AdminProductController::class, "created"])->name('created');
Route::put('/admin/product/{product_id}', [AdminProductController::class, "update"])->name('update');


Route::post("/create/product", [ProductController::class, 'create']);

Route::post("/edit/product", [ProductController::class, 'edit']);

Route::post("/update/product", [ProductController::class, 'update']);

Route::post("/delete/product", [ProductController::class, 'destroy']);


// Product

Route::post("/product/tags/{id}", [ProductController::class, "giveTags"]);

Route::post("/product/add_tags/{id}", [ProductController::class, "addTag"]);

Route::post("/product/remove_tag/{id}", [ProductController::class, "removeTag"]);

Route::post("/product/update-stock/{id}", [ProductController::class, "updateStock"]);

Route::post("/product/all-type", [ProductController::class, "giveAllProductType"]);

Route::get("/admin/product_manage", [AdminController::class, "giveProducts"])->name('tagindex');

// Reports functionality

Route::post("/admin/viewRevenue", [AdminController::class, "giveRevenue"]);



// Orders Based
Route::post("/admin/viewTotalOrders/{}");

Route::get("/admin/viewOrders", [AdminController::class, "giveOrders"]);
Route::post("/admin/viewOrders/{}");


Route::get("/admin/viewCategoryRevenue", [AdminController::class, "giveCategoryRevenue"]);

Route::post("/admin/viewCategoryRevenue", [AdminController::class, "giveCategoryRevenue"]);


// User
Route::post("/admin/findUser/");;

Route::get(uri: "/admin/registeredUsers", action: [AdminController::class, "giveRegisteredUsers"]);

Route::post(uri: "/admin/registeredUsers", action: [AdminController::class, "giveRegisteredUsers"]);

Route::post(uri: "/admin/registeredUsers_time", action: [AdminController::class, "giveRegisteredUsers_time"]);


Route::post("/admin/findUser", [AdminController::class, "findUser"]);

// Route::get('/filter-products', [RequirementController::class, 'filterProducts']);

Route::get('/admin', [AdminController::class, "giveAdminHub"])->name("adminHub");


// Tag

Route::post("/tags", [TagController::class, "index"]);
Route::get("/tags", [TagController::class, "tagPage"])->name('tagpage');

Route::put("/tags/create", [TagController::class, "store"]);

Route::put("/tags/update/{id}", [TagController::class, "update"]);

Route::delete("/tags/{id}", [TagController::class, "destroy"]);


// Messages

Route::get("/messages", [ContactController::class, "indexPage"])->name("messages");

Route::delete("/messages/{id}", [ContactController::class, "destroy"]);

Route::post("/message/{id}", [ContactController::class, "respond"]);

Route::get("/admin/product_manage", [AdminController::class, "giveProducts"])->name('tagindex');


//Returns
Route::get('/orders/{orders}/return', [ReturnedOrderController::class, 'create'])->name('order.return');
Route::post('/orders/{orders}/return', [ReturnedOrderController::class, 'store'])->name('order.return.store');



// Accounts

Route::get("/accounts", [AuthController::class, "index"])->name("accounts");

Route::post("/account/getOrders/{id}", [CustomerController::class, "giveUserOrders"]);

Route::post("/account/destroy/{id}", [CustomerController::class, "destroy"]);

