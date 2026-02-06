<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBlacklist
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->status === 'blacklist') {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda telah di-blacklist. Hubungi admin.']);
        }

        return $next($request);
    }
}
