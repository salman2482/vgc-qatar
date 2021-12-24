<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the CareersApply
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\CareersApply;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //render the form
        $html = view('pages/careerapply/components/actions/attach-dettach', compact('careerapply'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#actionsModalBody',
            'action' => 'replace',
            'value' => $html);

        //show modal careerapply
        $jsondata['dom_visibility'][] = array('selector' => '#actionsModalFooter', 'action' => 'show');

        //ajax response
        return response()->json($jsondata);

    }

}
