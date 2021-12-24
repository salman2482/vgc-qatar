<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the FrontClients
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\FrontClients;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for frontclients
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //frontclient id
        $id = $frontclients->first()->frontclient_id;

        //we dettached [client or frontclient] from regular frontclients list page
        if (!request()->filled('frontclientresource_type')) {
            $html = view('pages/frontclients/components/table/ajax', compact('frontclients'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#frontclient_$id",
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
