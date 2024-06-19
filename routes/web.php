<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectSkillController;
use App\Http\Controllers\SkillController;
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

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::prefix('about')->group(function () {
            Route::get('/', [AboutController::class, 'index'])->name('about.index');
            Route::post('/post', [AboutController::class, 'store'])->name('about.post');
            Route::put('/{id}/update', [AboutController::class, 'update'])->name('about.update');
        });
        Route::resource('/educations', EducationController::class);
        Route::resource('/certificates', CertificatesController::class);
        Route::resource('/projects', ProjectsController::class);
        Route::prefix('projects/{id}/skills')->group(function () {
            Route::get('/', [ProjectSkillController::class, 'index'])->name('projectSkills.index');
            Route::post('/post', [ProjectSkillController::class, 'store'])->name('projectSkills.post');
            Route::delete('/{iddel}/delete', [ProjectSkillController::class, 'delete'])->name('projectSkills.delete');
        });
        Route::resource('/skills', SkillController::class);
        Route::resource('/contacts', ContactController::class);
    });
});

require __DIR__.'/auth.php';
