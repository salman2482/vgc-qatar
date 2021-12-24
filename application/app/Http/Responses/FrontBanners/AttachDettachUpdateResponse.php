<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [attach] process for the FrontBanners
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\FrontBanners;
use Illuminate\Contracts\Support\Responsable;

class AttachDettachUpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for frontbanners
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //frontbanner id
        $id = $frontbanners->first()->frontbanner_id;

        //we dettached [client or frontbanner] from regular frontbanners list page
        if (!request()->filled('frontbannerresource_type')) {
            $html = view('pages/frontbanners/components/table/ajax', compact('frontbanners'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#frontbanner_$id",
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
