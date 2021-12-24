<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the vendorrfqs
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\VendorRfqs;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for vendorrfqs
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //vendorrfq id
        $id = $vendorrfqs->first()->vendorrfq_id;

        //we dettached [client or project] from regular vendorrfqs list page
        if (!request()->filled('vendorrfqresource_type')) {
            $html = view('pages/vendorrfqs/components/table/ajax', compact('vendorrfqs'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#vendorrfq_$id",
                'action' => 'replace-with',
                'value' => $html);
        }

        
        //close modal
        $jsondata['dom_visibility'][] = array('selector' => '#actionsModal', 'action' => 'close-modal');

        //notice
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //response
        return response()->json($jsondata);

    }

}
