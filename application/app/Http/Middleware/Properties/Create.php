<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [create] precheck processes for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Properties;

use Closure;
use Log;

class Create
{

    /**
     * This middleware does the following:
     *   1. checks users permissions to [create] a new resource
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //frontend
        $this->fronteEnd();

        //does user have permission to create a new project
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_property >= 1 || auth()->user()->is_admin) {
                //permission granted
                return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][properties][create]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd()
    {


        //permissions -viewing
        if (auth()->user()->role->role_property >= 1) {
            config([
                'visibility.list_page_actions_search' => true,
            ]);
        }

        //permissions -adding
        if (auth()->user()->role->role_property >= 2) {
            config([
                'visibility.list_page_actions_add_button' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.property_col_action' => true,
            ]);
        }

        //permissions -deleting
        if (auth()->user()->role->role_property >= 3) {
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
