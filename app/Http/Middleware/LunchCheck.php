<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LunchCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $lunchBreakFirsttime = '13:00';
        $lunchBreakLasttime = '14:00';

        $totime = date("H:i");

        if($totime >= $lunchBreakFirsttime && $totime <= $lunchBreakLasttime){
            // 관리자는 제외
            if(Auth::id() !== 1){
                return redirect(route('lunchBreak'));
            }
        }
        return $next($request);
    }
}
