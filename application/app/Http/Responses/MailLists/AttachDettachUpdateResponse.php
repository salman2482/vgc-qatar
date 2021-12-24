<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the properties
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Properties;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for properties
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //property id
        $id = $properties->first()->property_id;

        //we dettached [client or project] from regular properties list page
        if (!request()->filled('propertyresource_type')) {
            $html = view('pages/properties/components/table/ajax', compact('properties'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#property_$id",
                'action' => 'replace-with',
                'value' => $html);
        }

        // //we dettached [client] from an embedded [client] page
        // if (request('propertyresource_type') == 'client' && !is_numeric(request('property_clientid'))) {
        //     $jsondata['dom_visibility'][] = array(
        //         'selector' => "#property_$id",
        //         'action' => 'slideup-slow-remove',
        //     );
        // }

        // //we dettached [project] from an embedded [project] page
        // if (request('propertyresource_type') == 'project' && !is_numeric(request('property_projectid'))) {
        //     $jsondata['dom_visibility'][] = array(
        //         'selector' => "#property_$id",
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
