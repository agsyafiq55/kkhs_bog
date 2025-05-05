<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureLivewireUploadsUsePost
{
    public function handle(Request $request, Closure $next)
    {
        if (strpos($request->path(), 'livewire/upload-file') !== false && !$request->isMethod('POST')) {
            // Log this issue for debugging
            \Illuminate\Support\Facades\Log::warning('Livewire upload request was not POST', [
                'method' => $request->method(),
                'path' => $request->path()
            ]);

            // Force the request method to be POST
            $request->setMethod('POST');
        }

        return $next($request);
    }
}