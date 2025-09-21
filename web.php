<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here we register a route for the “Tentang Kami” (About Us) page. When
| a visitor navigates to `/tentang-kami`, the AboutController’s
| `show` method will fetch the dynamic content from the database and
| render it using the `about` Blade view. The route is named `about`
| to simplify linking within Blade templates.
|
*/
Route::get('/tentang-kami', [AboutController::class, 'show'])->name('about');