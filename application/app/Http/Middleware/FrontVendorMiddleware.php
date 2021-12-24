<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FrontVendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guest()) {
            return redirect()->route('front.vendor.login');
        }elseif(auth()->user()){
            if(auth()->user()->vendor != 1){
            return redirect()->route('front.vendor.login')->with('message','Only Vendors are allowed');
            }
            if(auth()->user()->status != 'active'){
                return redirect()->route('front.vendor.login')->with('message','You Are Suspendid');
            }
        }
        return $next($request);
    }
}
