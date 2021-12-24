<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Services;

use Illuminate\Support\Facades\Log;
use Closure;


class Index {

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //frontend
        $this->fronteEnd();
         //admin user permission
            if (auth()->user()->is_admin) {
                return $next($request);
            }


        //permission denied
        Log::error("permission denied", ['process' => '[permissions][services][index]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {


        if (auth()->user()->is_admin) {
            config([
                //visibility
                'visibility.list_page_actions_search' => true,
                'visibility.action_buttons_delete' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.list_page_actions_add_button_service' => true,
                'visibility.property_col_action' => true,
            ]);
        }

    }
}
