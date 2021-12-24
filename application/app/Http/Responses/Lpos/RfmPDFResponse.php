<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [pdf] process for the invoices
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Lpos;
// use App\Http\Responses\Invoices\PDFResponse;
use Illuminate\Contracts\Support\Responsable;
use Barryvdh\DomPDF\Facade as PDF;


class RfmPDFResponse implements Responsable {

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
        // dd($this->payload);
        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //[debugging purposes] view invoice in browser (https://domain.com/invoice/1/pdf?view=preview)
        if (request('view') == 'preview') {
            config(['css.bill_mode' => 'pdf-mode-preview']);
            return view('pages/lpo/components/misc/lpo-pdf', compact('lpo'))->render();
        }

        //download pdf view
        config(['css.bill_mode' => 'pdf-mode-download']);
        // return view('pages/lpo/components/misc/lpo-pdf', compact('lpo','attachments'))->render();
        $pdf = PDF::loadView('pages/lpo/components/misc/lpo-pdf', compact('lpo','attachments'));
        $filename = $lpo->ref_no . '.pdf'; //invoice_inv0001.pdf
        return $pdf->download($filename);
    }
}
