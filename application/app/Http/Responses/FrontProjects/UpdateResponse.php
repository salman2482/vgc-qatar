<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the FrontProjects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\FrontProjects;
use Illuminate\Contracts\Support\Responsable;

class UpdateResponse implements Responsable {

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
       $request['ref'] = 'list';
        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //update initiated on a list page
        if (request('ref') == 'list') {
            //replace the row of this record
            $html = view('pages/frontproject/components/table/ajax', compact('frontprojects'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#frontproject_" . $frontprojects->first()->id,
                'action' => 'replace-with',
                'value' => $html);

            //close modal
            $jsondata['dom_visibility'][] = array('selector' => '.modal', 'action' => 'close-modal');

            //notice
            $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        }

        //editing from main page
        if (request('ref') == 'page') {
            //close modal
            $jsondata['dom_visibility'][] = array('selector' => '.modal', 'action' => 'close-modal');

            //redirect to project page
            $jsondata['redirect_url'] = url("frontprojects/$id");
        }

        //response
        return response()->json($jsondata);
    }

}
