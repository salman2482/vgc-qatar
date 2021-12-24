<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [show] process for the notes
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Rfms;
use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable {

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

        // render the form
        $html = view('pages/rfms/components/modals/show-rfm', compact('rfm','attachments','materials'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#plainModalBody',
            'action' => 'replace',
            'value' => $html);

        //ajax response
        return response()->json($jsondata);

        // return view('pages/bill/wrapper', compact('page', 'bill', 'taxrates', 'taxes', 'elements', 'units', 'lineitems'))->render();

}
}
