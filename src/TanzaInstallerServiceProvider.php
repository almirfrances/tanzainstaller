<?php

namespace AlmirFrances\TanzaInstaller;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use AlmirFrances\TanzaInstaller\Http\Middleware\CheckInstallationStep;
use AlmirFrances\TanzaInstaller\Http\Middleware\EnsureInstallationCompleted;

class TanzaInstallerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerMiddleware();
        // Register the views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'installer');

        // Register the routes
        $this->registerRoutes();

        // Bypass .env dependency by setting fallback configuration values
        $this->setDefaultConfigurations();
    }

    protected function registerMiddleware()
{
    $this->app['router']->prependMiddlewareToGroup('web', \AlmirFrances\TanzaInstaller\Http\Middleware\EnsureInstallationCompleted::class);
}






    /**
     * Register the package's routes.
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            // Step 1: Introduction
            Route::get('/install', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'step1'])
                ->name('installer.step1');

            // Step 2: System Requirements
            Route::get('/install/requirements', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'step2'])
                ->name('installer.step2');

            // Step 3: Database Configuration Form
            Route::get('/install/database', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'step3'])
                ->name('installer.step3');

            // Step 3: Save Database Configuration
            Route::post('/install/database', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'saveDatabase'])
                ->name('installer.saveDatabase');

            // Step 4: Admin Configuration Form
            Route::get('/install/install-database', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'step4'])
                ->name('installer.step4');

             Route::post('/install/install-database', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'installDatabase'])
                ->name('installer.installDatabase');

            Route::get('/install/admin', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'step5'])
                ->name('installer.step5');

            Route::post('/install/admin', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'saveAdmin'])
                ->name('installer.saveAdmin');

            Route::get('/install/complete', [\AlmirFrances\TanzaInstaller\Http\Controllers\InstallerController::class, 'complete'])
                ->name('installer.complete');
        });
    }



    /**
     * Get the route group configuration array.
     *
     * @return array
     */
    protected function routeConfiguration()
    {
        return [
            'middleware' => ['web'], // No alias here
            'namespace'  => 'AlmirFrances\TanzaInstaller\Http\Controllers',
        ];
    }




       /**
     * Set default configurations to bypass .env dependency.
     */
    protected function setDefaultConfigurations()
    {
        // Temporary encryption key fallback
        if (!config('app.key')) {
            config(['app.key' => 'base64:' . base64_encode(random_bytes(32))]);
        }

             // Set session driver to 'file'
    config(['session.driver' => 'file']);
    config(['session.files' => storage_path('framework/sessions')]);

    // Ensure sessions are started
    session()->start();

    // Prevent cookie-related issues
    config(['session.cookie' => 'installer_session']);
    config(['session.secure' => false]);
    config(['session.http_only' => true]);
    config(['session.same_site' => 'lax']);
    config(['app.debug' => true]);
        // Example: App fallback values
        config([
            'app.name' => config('app.name', 'Laravel Installer'),
        ]);
    }
}