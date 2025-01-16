<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index'])->name('posts.index'); // Главная страница
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Добавление поста
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit'); // Форма редактирования
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update'); // Обновление поста
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // Удаление поста
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::resource('posts', PostController::class);
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::post('comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
// Удаление комментария
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Редактирование комментария (отображение формы)
Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');

// Обновление комментария (отправка формы)
Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');



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

Route::get('/', function () {
    return view('welcome');
});
