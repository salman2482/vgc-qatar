<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Rfms;

use App\Models\Rfm;
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
        //permission: does user have permission view clients
        if (auth()->user()->role->role_rfms >= 1 || auth()->user()->is_client) {
             //[limit] - for users with only local level scope
            if (auth()->user()->role->role_rfms_scope == 'own' || auth()->user()->is_client) {
                request()->merge(['filter_my_rfms' => array(auth()->id())]);
            }
            return $next($request);
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][rfms][index]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'user_id' => auth()->id()]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        //permissions -viewing
        if (auth()->user()->role->role_rfms >= 1) {
            config([
                'visibility.list_page_actions_search' => true,
            ]);
        }

        //permissions -adding
        if (auth()->user()->role->role_rfms >= 2) {
            config([
                'visibility.list_page_actions_add_button' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.action_column' => true,
            ]);
        }

        //permissions -deleting
        if (auth()->user()->role->role_rfms >= 3) {
            config([
                'visibility.action_column' => true,
                'visibility.list_page_actions_search' => true,
                'visibility.action_buttons_delete' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.list_page_actions_add_button' => true,
                'visibility.list_page_actions_add_material' => true,

            ]);
        }

        if (auth()->user()->is_admin) {
            config([
                //visibility
                'visibility.action_column' => true,
                'visibility.list_page_actions_search' => true,
                'visibility.action_buttons_delete' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.list_page_actions_add_button' => true,
                'visibility.list_page_actions_add_material' => true,
            ]);
        }

        if (auth()->user()->role->role_rfms_scope == 'own') {
            config([
                'visibility.status_button' => true,
            ]);
        }

    }
}
