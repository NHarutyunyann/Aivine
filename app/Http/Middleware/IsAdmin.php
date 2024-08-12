<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('id', \auth()->id())->active()->first();
        if ($user && $user->hasAnyRole(['Admin', 'Super Admin'])) {
            return $next($request);
        }


        Auth::logout();
        return redirect('/');
    }
}
