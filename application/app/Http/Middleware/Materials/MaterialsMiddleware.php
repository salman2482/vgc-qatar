<?php

namespace App\Http\Middleware\Materials;

use Closure;

class MaterialsMiddleware
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
        $this->fronteEnd();
        if (auth()->user()->is_admin || auth()->user()->role_rfms >= 3) {
            return $next($request);
        }
        abort(401);
    }

    function fronteEnd(){
        if (auth()->user()->is_admin) {
            config([
                //visibility
                'visibility.list_page_actions_search' => true,
                'visibility.action_buttons_delete' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.list_page_actions_add_button' => true,
                'visibility.property_col_action' => true,
                'visibility.list_page_actions_filter_button' => true,
            ]);
        }
    }
}
