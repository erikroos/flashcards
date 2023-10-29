<?php

namespace App\Http\Middleware;

use App\Models\Set;
use App\Models\Run;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route('set_id') != null) {
            $set = Set::where('id', $request->route('set_id'))->first();
            if ($set->user_id != Auth::id()) {
                return redirect('/');
            }
        }

        if ($request->route('run_id') != null) {
            $run = Run::where('id', $request->route('run_id'))->first();
            if ($run->user_id != Auth::id()) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
