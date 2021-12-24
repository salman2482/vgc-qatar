<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store] process for the vendorrfq
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\VendorRfqs;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable {

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

        //redirect to vendorrfq page
        if (request('show_after_adding') == 'on') {
            $jsondata['redirect_url'] = url("/vendorrfqs/$id");

        } else {

            //prepend content on top of list or show full table
            if ($count == 1) {
                $html = view('pages/vendorrfq/components/table/table', compact('vendorrfqs'))->render();
                $jsondata['dom_html'][] = array(
                    'selector' => '#vendorrfqs-table-wrapper',
                    'action' => 'replace',
                    'value' => $html);
            } else {
                //prepend content on top of list
                $html = view('pages/vendorrfq/components/table/ajax', compact('vendorrfqs'))->render();
                $jsondata['dom_html'][] = array(
                    'selector' => '#vendorrfqs-td-container',
                    'action' => 'prepend',
                    'value' => $html);
            }

            //close modal
            $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

            //notice
            $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));
        }

        //response
        return response()->json($jsondata);

    }

}
