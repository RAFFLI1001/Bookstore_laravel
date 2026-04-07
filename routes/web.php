<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, HomeController, BookController, CartController, OrderController, PageController};
use App\Http\Controllers\Admin\{DashboardController, CategoryController as AdminCategoryController, BookController as AdminBookController, UserController as AdminUserController, OrderController as AdminOrderController};

Route::get('/', [HomeController::class, 'index']);
Route::get('/books/search', [BookController::class, 'search']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contact', [PageController::class, 'sendMessage']);

Route::get('/register', [AuthController::class, 'registerForm'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'loginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::delete('/cart/{id}', [CartController::class, 'remove']);
    Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::get('/orders', [OrderController::class, 'myOrders']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('books', AdminBookController::class);
    Route::get('/users', [AdminUserController::class, 'index']);
    Route::get('/orders', [AdminOrderController::class, 'index']);
    Route::patch('/cart/update/{id}', [CartController::class, 'update']);

    Route::patch('/orders/{id}/terima', [AdminOrderController::class, 'terima']);
    Route::patch('/orders/{id}/tolak',  [AdminOrderController::class, 'tolak']);
    Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus']);
});