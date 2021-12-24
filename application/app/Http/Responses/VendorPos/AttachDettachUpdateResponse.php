<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the vendorpos
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\VendorPos;

use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for vendorpos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //vendorpo id
        $id = $vendorpos->first()->vendorpo_id;

        //we dettached [client or project] from regular vendorpos list page
        if (!request()->filled('vendorporesource_type')) {
            $html = view('pages/vendorpos/components/table/ajax', compact('vendorpos'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#vendorpo_$id",
                'action' => 'replace-with',
                'value' => $html);
        }

        // //we dettached [client] from an embedded [client] page
        // if (request('vendorporesource_type') == 'client' && !is_numeric(request('vendorpo_clientid'))) {
        //     $jsondata['dom_visibility'][] = array(
        //         'selector' => "#vendorpo_$id",
        //         'action' => 'slideup-slow-remove',
        //     );
        // }

        // //we dettached [project] from an embedded [project] page
        // if (request('vendorporesource_type') == 'project' && !is_numeric(request('vendorpo_projectid'))) {
        //     $jsondata['dom_visibility'][] = array(
        //         'selector' => "#vendorpo_$id",
        //         'action' => 'slideup-slow-remove',
        //     );
        // }

        //close modal
        $jsondata['dom_visibility'][] = array('selector' => '#actionsModal', 'action' => 'close-modal');

        //notice
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //response
        return response()->json($jsondata);

    }

}
