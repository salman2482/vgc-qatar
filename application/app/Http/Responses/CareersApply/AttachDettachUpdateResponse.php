<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the CareersApply
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\CareersApply;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for careersapply
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //careerapply id
        $id = $careersapply->first()->career_id;

        //we dettached [careerapply or careerapply] from regular careersapply list page
        if (!request()->filled('careerresource_type')) {
            $html = view('pages/careerapply/components/table/ajax', compact('careersapply'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#career_$id",
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
