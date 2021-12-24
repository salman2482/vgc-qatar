<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store] process for the CorporateServices
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\CorporateServices;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable {

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

        //redirect to corporateservice page
        if (request('show_after_adding') == 'on') {
            $jsondata['redirect_url'] = url("/corporateservices/$id");
        } else {
            
            //prepend content on top of list or show full table
            if ($count == 1) {
                $html = view('pages/corporateservice/components/table/table', compact('corporateservices'))->render();
                $jsondata['dom_html'][] = array(
                    'selector' => '#corporateservices-table-wrapper',
                    'action' => 'replace',
                    'value' => $html);
                } else {
                    //prepend content on top of list
                    $html = view('pages/corporateservice/components/table/ajax', compact('corporateservices'))->render();
                    $jsondata['dom_html'][] = array(
                        'selector' => '#corporateservices-td-container',
                        'action' => 'prepend',
                        'value' => $html);
                    }
                    
                    //close modal
                    $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');
                    
                    //notice
                    $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));
                }

        //response
        return response()->json($jsondata);
        // return redirect()->route('corporateservices.index');

    }

}
