<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [create] process for the FrontBanners
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\FrontBanners;
use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable {

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

        //render the form
        $html = view('pages/frontbanner/components/modals/add-edit-inc', compact('page','frontbanner'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#commonModalBody',
            'action' => 'replace',
            'value' => $html);

        //show modal footer
        $jsondata['dom_visibility'][] = array('selector' => '#commonModalFooter', 'action' => 'show');

        // POSTRUN FUNCTIONS------
        $jsondata['postrun_functions'][] = [
            'value' => 'NXAddEditFrontBanner',
        ];

        //ajax response
        return response()->json($jsondata);
    }

}