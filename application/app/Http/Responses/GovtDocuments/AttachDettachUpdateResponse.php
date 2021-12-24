<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the govtdocuments
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\GovtDocuments;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for govtdocuments
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //govtdocument id
        $id = $govtdocuments->first()->govtdocument_id;

        //we dettached [client or project] from regular govtdocuments list page
        if (!request()->filled('govtdocumentresource_type')) {
            $html = view('pages/govtdocuments/components/table/ajax', compact('govtdocuments'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#govtdocument_$id",
                'action' => 'replace-with',
                'value' => $html);
        }

        // //we dettached [client] from an embedded [client] page
        // if (request('govtdocumentresource_type') == 'client' && !is_numeric(request('govtdocument_clientid'))) {
        //     $jsondata['dom_visibility'][] = array(
        //         'selector' => "#govtdocument_$id",
        //         'action' => 'slideup-slow-remove',
        //     );
        // }

        // //we dettached [project] from an embedded [project] page
        // if (request('govtdocumentresource_type') == 'project' && !is_numeric(request('govtdocument_projectid'))) {
        //     $jsondata['dom_visibility'][] = array(
        //         'selector' => "#govtdocument_$id",
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
