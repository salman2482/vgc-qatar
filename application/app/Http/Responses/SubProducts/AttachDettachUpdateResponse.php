<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the SubProducts
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\SubProducts;
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

        //subproduct id
        $id = $subproducts->first()->subproduct_id;

        //we dettached [career or subproduct] from regular subproducts list page
        if (!request()->filled('subproductresource_type')) {
            $html = view('pages/subproduct/components/table/ajax', compact('subproducts'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#subproduct_$id",
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
