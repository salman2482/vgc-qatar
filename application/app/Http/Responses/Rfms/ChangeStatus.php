<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [edit] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Rfms;
use Illuminate\Contracts\Support\Responsable;

class ChangeStatus implements Responsable {

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

        //content
        $html = view('pages/rfms/components/modals/change-status', compact('page', 'rfm','users'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#commonModalBody',
            'action' => 'replace',
            'value' => $html);

        //show modal footer
        $jsondata['dom_visibility'][] = array('selector' => '#commonModalFooter', 'action' => 'show');

        
        // POSTRUN FUNCTIONS------
        $jsondata['postrun_functions'][] = [
            'value' => 'NXAddEditRfm',
        ];
        //ajax response
        return response()->json($jsondata);
    }

}
