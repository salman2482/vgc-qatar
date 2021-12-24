<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the FrontProjects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\FrontProjects;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for frontprojects
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //frontproject id
        $id = $frontprojects->first()->frontproject_id;

        //we dettached [client or frontproject] from regular frontprojects list page
        if (!request()->filled('frontprojectresource_type')) {
            $html = view('pages/frontprojects/components/table/ajax', compact('frontprojects'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#frontproject_$id",
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
