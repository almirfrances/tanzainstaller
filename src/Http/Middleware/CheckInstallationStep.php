<?php

namespace AlmirFrances\TanzaInstaller\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInstallationStep
{
    public function handle(Request $request, Closure $next, $requiredStep)
    {
        // Check if the current step is completed
        if (!session()->has('step' . $requiredStep . '_completed')) {
            return redirect()->route('installer.step' . $requiredStep)
                ->withErrors(['access_error' => "You must complete Step $requiredStep before accessing this step."]);
        }

        return $next($request);
    }
}
