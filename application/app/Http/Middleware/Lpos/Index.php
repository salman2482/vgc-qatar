<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Lpos;

use Closure;
use Log;

class Index {

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //    front end
        $this->fronteEnd();
        //admin user permission
            if (auth()->user()->role->role_lpos >= 1 || auth()->user()->is_admin) {
                return $next($request);
            }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][lpos][index]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

          //permissions -viewing
          if (auth()->user()->role->role_lpos >= 1) {
            config([
                'visibility.list_page_actions_search' => true,
            ]);
        }

        //permissions -adding
        if (auth()->user()->role->role_lpos >= 2) {
            config([
                'visibility.list_page_actions_add_button' => false,
                'visibility.action_buttons_edit' => true,
                'visibility.property_col_action' => true,
            ]);
        }

        //permissions -deleting
        if (auth()->user()->role->role_lpos >= 3) {
            config([
                'visibility.list_page_actions_search' => true,
                'visibility.action_buttons_delete' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.list_page_actions_add_button' => true,
                'visibility.property_col_action' => true,
            ]);
        }

        if (auth()->user()->is_admin) {
            config([
                //visibility
                'visibility.list_page_actions_search' => true,
                'visibility.action_buttons_delete' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.list_page_actions_add_button' => true,
                'visibility.property_col_action' => true,
            ]);
        }
    }
}
