<?php

/** ---------------------------------------------------------------------------------------------------
 * Email Cron
 * Send emails that are stored in the email queue (database)
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 *      - the scheduler is set to run this every minuted
 *      - the schedler itself is evoked by the signle cronjob set in cpanel (which runs every minute)
 * @package    Grow CRM
 * @author     NextLoop
 *-----------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs;

use Log;
use Carbon\Carbon;
use App\Mail\SendQueued;
use App\Models\ContractMgt;
use App\Mail\ContractExpiredMail;
use App\Mail\DocumentExpiredMail;
use App\Mail\EmployeeExpiredDocuments;
use App\Models\DocumentManagment;
use App\Models\EmployeLegalDocument;
use App\Models\Quotation;
use App\Models\Settings;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Log\Logger;

class EmailCron
{

    public function __invoke()
    {
        // emails for contracts,docs,quotation
        $contracts = ContractMgt::all();
        $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;
        foreach ($contracts as $contract) {
            $expired_date = new  Carbon($contract->expiray_date);
            $date = Carbon::now();
            $final_date = $expired_date->diffInDays($date);

            if ($final_date ==  15) {
                if ($contract->fifteen_days == 0) {
                    Mail::to($admin_mail)->send(new ContractExpiredMail($contract, $final_date));
                    $contract->fifteen_days = 1;
                    $contract->save();
                }
            }

            if ($final_date == 60 ) {
                if ($contract->sixty_days == 0) {
                    Mail::to($admin_mail)->send(new ContractExpiredMail($contract, $final_date));
                    $contract->sixty_days = 1;
                    $contract->save();
                }
            }
        }

        $documents = DocumentManagment::all();
        foreach ($documents as $doc) {
            $expired_date = new  Carbon($doc->expiration);
            $date = Carbon::now();
            $final_date = $expired_date->diffInDays($date);
            if ($final_date ==  15)
            {
                if ($doc->fifteen_days == 0)
                {
                    Mail::to($admin_mail)->send(new DocumentExpiredMail($doc, $final_date));
                    $doc->fifteen_days = 1;
                    $doc->save();
                }
            }
            if ($final_date == 60)
            {
                if ($doc->sixty_days == 0)
                {
                    Mail::to($admin_mail)->send(new DocumentExpiredMail($doc, $final_date));
                    $doc->sixty_days = 1;
                    $doc->save();
                }
            }
        }

        $quotations = Quotation::all();
        foreach ($quotations as $quotation) {
            $expired_date = new  Carbon($quotation->expiration);
            $date = Carbon::now();
            $final_date = $expired_date->diffInDays($date);
            if ($final_date ==  15)
            {
                if ($quotation->fifteen_days == 0)
                {
                    Mail::to($admin_mail)->send(new DocumentExpiredMail($quotation, $final_date));
                    $quotation->fifteen_days = 1;
                    $quotation->save();
                }
            }
            if ($final_date == 60)
            {
                if ($quotation->sixty_days == 0)
                {
                    Mail::to($admin_mail)->send(new DocumentExpiredMail($quotation, $final_date));
                    $quotation->sixty_days = 1;
                    $quotation->save();
                }
            }
        }

        $employees = EmployeLegalDocument::all();
        foreach ($employees as $employee) {
            $expired_date = new  Carbon($employee->expiration);
            $date = Carbon::now();
            $final_date = $expired_date->diffInDays($date);
            if ($final_date ==  15)
            {
                if ($employee->fifteen_days == 0)
                {
                    Mail::to($admin_mail)->send(new EmployeeExpiredDocuments($employee, $final_date));
                    $employee->fifteen_days = 1;
                    $employee->save();
                }
            }
            if ($final_date == 60)
            {
                if ($employee->sixty_days == 0)
                {
                    Mail::to($admin_mail)->send(new EmployeeExpiredDocuments($employee, $final_date));
                    $employee->sixty_days = 1;
                    $employee->save();
                }
            }
        }
        /**
         * Send emails
         *   These emails are being sent every minute. You can set a higher or lower sending limit.
         */
        $limit = 20;
        if ($emails = \App\Models\EmailQueue::Where('emailqueue_type', 'general')->where('emailqueue_status', 'new')->take($limit)->get()) {

            //mark all emails in the batch as processing - to avoid batch duplicates/collisions
            foreach ($emails as $email) {
                $email->update([
                    'emailqueue_status' => 'processing',
                    'emailqueue_started_at' => now(),
                ]);
            }

            //now process
            foreach ($emails as $email) {

                //send the email
                Mail::to($email->emailqueue_to)->send(new SendQueued($email));
                //log email
                $log = new \App\Models\EmailLog();
                $log->emaillog_email = $email->emailqueue_to;
                $log->emaillog_subject = $email->emailqueue_subject;
                $log->emaillog_body = $email->emailqueue_message;
                $log->save();
                //delete email from the queue
                \App\Models\EmailQueue::Where('emailqueue_id', $email->emailqueue_id)->delete();
            }

            //reset existing account owner
            \App\Models\Settings::where('settings_id', 1)
                ->update([
                    'settings_cronjob_has_run' => 'yes',
                    'settings_cronjob_last_run' => now(),
                ]);
        }

        //[UPCOMING] update database for items marked as processing but never completed. Mark them as 'new'. Based on processing timestamp

    }
}
