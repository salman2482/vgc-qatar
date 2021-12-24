<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [show dynamic] process for the FrontBanners
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\FrontBanners;
use Illuminate\Contracts\Support\Responsable;

class ShowDynamicResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for team members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        return view('pages/frontbanner/dynamic', compact('page', 'frontbanner'))->render();
    }

}