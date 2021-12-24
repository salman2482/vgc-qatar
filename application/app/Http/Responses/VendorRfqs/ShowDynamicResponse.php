<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [show dynamic] process for the vendorrfq
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\VendorRfqs;
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

        return view('pages/vendorrfq/dynamic', compact('page', 'vendorrfq'))->render();
    }

}
