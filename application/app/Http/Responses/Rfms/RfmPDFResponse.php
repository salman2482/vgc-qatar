<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [pdf] process for the invoices
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Rfms;
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
        // $test = $this->payload['attachments']->first();
        // $image = base64_encode(file_get_contents(asset('rfms/attachments/download/'.$test->attachment_uniqiueid)));

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }
        // //[debugging purposes] view invoice in browser (https://domain.com/invoice/1/pdf?view=preview)
        // if (request('view') == 'preview') {
        //     config(['css.bill_mode' => 'pdf-mode-preview']);
        //     return view('pages/rfms/components/misc/rfm-pdf',compact('rfm','attachments'))->render();
        // }

        //download pdf view
        config(['css.bill_mode' => 'pdf-mode-download']);

        if (isset($manager)) {
            $pdf = PDF::loadView('pages/rfms/components/misc/rfm-pdf', ['rfm' => $rfm,'attachments' => $attachments,'materials' => $materials,'supervisor' => $supervisor,'manager' => $manager]);
            $filename = strtoupper(__('Rfm')) . '-' . $rfm->ref_num . '.pdf'; //invoice_inv0001.pdf
            if (isset($hoa))
            {
                $pdf = PDF::loadView('pages/rfms/components/misc/rfm-pdf', ['rfm' => $rfm,'attachments' => $attachments,'materials' => $materials,'supervisor' => $supervisor,'manager' => $manager,'hoa' => $hoa]);
                return $pdf->download($filename);
                // return view('pages/rfms/components/misc/rfm-pdf',compact('rfm','attachments','materials','supervisor','manager','hoa'));
            }
            return $pdf->download($filename);
            // return view('pages/rfms/components/misc/rfm-pdf',compact('rfm','attachments','materials','supervisor','manager'));
        }

        $pdf = PDF::loadView('pages/rfms/components/misc/rfm-pdf', ['rfm' => $rfm,'attachments' => $attachments,'materials' => $materials,'supervisor' => $supervisor]);
        $filename = strtoupper(__('Rfm')) . '-' . $rfm->ref_num . '.pdf'; //invoice_inv0001.pdf
        return $pdf->download($filename);
    }
}
