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

use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ExpiredQuotation
{
   public function __invoke()
   {
      $date = Carbon::parse(Carbon::now());
      $current_date = $date->format('Y-m-d');

      // near to expired
      $all_quotations = Quotation::all();
      foreach ($all_quotations as $all_quotaiton) {
         $expired_date = new  Carbon($all_quotaiton->expiration);
         $final_date = $expired_date->diffInDays($current_date);
         if ($final_date ==  15) {
            $all_quotaiton->status = 'near to expired';
            $all_quotaiton->save();
         }
      }

      $quotations = Quotation::where('expiration', '<=', $current_date)->get();
      foreach ($quotations as $quotation) {
         $quotation->status = 'expired';
         $quotation->save();
      }
   }
}
