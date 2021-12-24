<?php

/** -------------------------------------------------------------------------------------------------
 * Email Bills Cronob
 * Send invoice/estimate emails that need to generate a PDF file and attach it.
 * These emails are limited to a smaller number at a time (e.g. 5)
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 *      - the scheduler is set to run this every minuted
 *      - the schedler itself is evoked by the signle cronjob set in cpanel (which runs every minute)
 * @package    Grow CRM
 * @author     NextLoop
 *---------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs;

use App\Models\DocumentManagment;
use Carbon\Carbon;

class ExpiredDocs
{
  public function __invoke()
  {
    $date = Carbon::parse(Carbon::now());
    $current_date = $date->format('Y-m-d');

    $all_documents = DocumentManagment::all();
    foreach ($all_documents as $a_document) {
      $expired_date = new  Carbon($a_document->expiration);
      $final_date = $expired_date->diffInDays($current_date);

      if ($final_date ==  15) {
        $a_document->status = 'near to expired';
        $a_document->save();
      }
    }



    $documents = DocumentManagment::where('expiration', '<=', $current_date)->get();
    foreach ($documents as $document) {
      $document->status = 'expired';
      $document->save();
    }
  }
}
