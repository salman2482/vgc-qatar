<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [destroy] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\EmployeeLegal;
use Illuminate\Contracts\Support\Responsable;

class DestroyResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * remove the item from the view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //hide and remove row
        $jsondata['dom_visibility'][] = array(
            'selector' => '#employee_' . $id,
            'action' => 'slideup-slow-remove',
        );

        //notice
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        return response()->json($jsondata);

    }

}
