<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [show] process for the vendorqtn
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\VendorQtns;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        // //render the form
        // $html = view('pages/vendorqtn/components/modals/vendorqtn', compact('vendorqtn'))->render();
        // $jsondata['dom_html'][] = array(
        //     'selector' => '#plainModalBody',
        //     'action' => 'replace',
        //     'value' => $html);

        // //ajax response
        // return response()->json($jsondata);


        return view('pages/vendorqtn/components/table/show', compact('vendorqtn'))->render();

    }

}
