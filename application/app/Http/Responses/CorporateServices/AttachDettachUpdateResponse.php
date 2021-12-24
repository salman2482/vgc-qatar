<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the CorporateServices
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\CorporateServices;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for careers
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //corporateservice id
        $id = $corporateservices->first()->corporateservice_id;

        //we dettached [career or corporateservice] from regular corporateservices list page
        if (!request()->filled('corporateserviceresource_type')) {
            $html = view('pages/corporateservice/components/table/ajax', compact('corporateservices'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#corporateservice_$id",
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
