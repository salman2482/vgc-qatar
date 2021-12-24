<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Vendors;

use App\Models\Vendor;
use Closure;
use Log;

class Index {

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //frontend
        $this->fronteEnd();

        return $next($request);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        //page level javascript
        config([
            //visibility
            // 'visibility.list_page_actions_filter_button' => true,
            'visibility.list_page_actions_search' => true,
            'visibility.action_buttons_delete' => true,
            'visibility.action_buttons_edit' => true,
            'visibility.list_page_actions_add_button' => true,
        ]);

    }
}
