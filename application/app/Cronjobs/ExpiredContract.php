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

use App\Models\ContractMgt;
use Carbon\Carbon;

class ExpiredContract
{
  public function __invoke()
  {
    $date = Carbon::parse(Carbon::now());
    $current_date = $date->format('Y-m-d');

    // near to expired
    $all_contracts = ContractMgt::all();
    foreach ($all_contracts as $all_contract) {
      $expired_date = new  Carbon($all_contract->expiray_date);
      $final_date = $expired_date->diffInDays($current_date);
      if ($final_date ==  15) {
        $all_contract->status = 'near to expired';
        $all_contract->save();
      }
    }

    // expired
    $contracts = ContractMgt::where('expiray_date', '<=', $current_date)->get();
    foreach ($contracts as $contract) {
      $contract->status = 'expired';
      $contract->save();
    }
  }
}
