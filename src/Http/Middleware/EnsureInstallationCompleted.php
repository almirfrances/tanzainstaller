<?php

namespace AlmirFrances\TanzaInstaller\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureInstallationCompleted
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the application is not installed
        if (!config('installer.is_installed')) {
            // Allow access to installer routes only
            if (!$request->is('install*')) {
                return redirect('/install');
            }
        } else {
            // If installed, block access to installer routes
            if ($request->is('install*')) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
