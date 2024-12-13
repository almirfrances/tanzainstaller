<?php

use Illuminate\Support\Facades\Route;
use AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController;

Route::prefix('install')->group(function () {
    Route::get('/', [InstallerController::class, 'step1'])->name('installer.step1');
    Route::get('/requirements', [InstallerController::class, 'step2'])->name('installer.step2');
    Route::get('/database', [InstallerController::class, 'step3'])->name('installer.step3');
    Route::post('/database', [InstallerController::class, 'saveDatabase'])->name('installer.saveDatabase');
    Route::get('/Install-db', [InstallerController::class, 'step4'])->name('installer.step4');
    Route::post('/install-database', [InstallerController::class, 'installDatabase'])->name('installer.installDatabase');
    Route::get('/admin', [InstallerController::class, 'step5'])->name('installer.step5');
    Route::post('/admin', [InstallerController::class, 'saveAdmin'])->name('installer.saveAdmin');
    Route::get('/complete', [InstallerController::class, 'complete'])->name('installer.complete');



});