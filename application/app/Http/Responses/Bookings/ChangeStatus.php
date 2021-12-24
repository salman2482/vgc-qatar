<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [edit] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Bookings;

use Illuminate\Contracts\Support\Responsable;

class ChangeStatus implements Responsable
{

    private $payload;

    public function __construct($payload = array())
    {
        $this->payload = $payload;
    }

    /**
     * render the view for team members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //render the form
        $html = view('pages/bookings/components/actions/change-status', compact('booking'))->render();

        $jsondata['dom_html'][] = array(
            'selector' => '#actionsModalBody',
            'action' => 'replace',
            'value' => $html
        );

        $jsondata['dom_visibility'][] = array('selector' => '#actionsModalFooter', 'action' => 'show');

        //ajax response
        return response()->json($jsondata);
    }
}
