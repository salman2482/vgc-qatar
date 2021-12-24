<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for VendorInvoiceRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Mail\VendorInvoiceMail;
use App\Models\User;

use App\Models\VendorInvoice;
use Carbon\Carbon;
use App\Models\VendorQuotation;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;


class VendorInvoiceRepository
{
    
    /**
     * The projects repository instance.
     */
    protected $vendorinvoices;

    /**
     * Inject dependecies
     */
    public function __construct(VendorInvoice $vendorinvoices)
    {
        $this->vendorinvoices = $vendorinvoices;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object VendorinvoiceRepository collection
     */
    public function search($id = '', $data = [])
    {
        $vendorinvoices = $this->vendorinvoices->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $vendorinvoices->selectRaw('*');

        //params: vendorinvoice id
        if (is_numeric($id)) {
            $vendorinvoices->where('id', $id);
        }


        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $vendorinvoices->where(function ($query) {
                $query->where('vendor_invoices.id','=',request('search_query'));
                $query->orWhere('lpo_ref','LIKE','%'.request('search_query').'%');
                $query->orWhere('qtn_ref','LIKE','%'.request('search_query').'%');
                $query->orWhere('category','LIKE','%'.request('search_query').'%');
                $query->orWhere('delivery_date','LIKE','%'.request('search_query').'%');
                $query->orWhere('invoice_ref_no','LIKE','%'.request('search_query').'%');
                $query->orWhere('total_value','LIKE','%'.request('search_query').'%');
                $query->orWhere('upload_lpo_copy','LIKE','%'.request('search_query').'%');
                $query->orWhere('upload_invoice_copy','LIKE','%'.request('search_query').'%');
                $query->orWhere('status','LIKE','%'.request('search_query').'%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //others
                    switch (request('orderby')) {
                    case 'id':
                    $vendorinvoices->orderBy('id', request('sortorder'));
                    break;
                    case 'id':
                        $vendorinvoices->orderBy('id', request('sortorder'));
                        break;case 'lpo_ref':
                            $vendorinvoices->orderBy('lpo_ref', request('sortorder'));
                            break;case 'category':
                                $vendorinvoices->orderBy('category', request('sortorder'));
                                break;case 'delivery_date':
                                    $vendorinvoices->orderBy('delivery_date', request('sortorder'));
                                    break;case 'invoice_ref_no':
                                        $vendorinvoices->orderBy('invoice_ref_no', request('sortorder'));
                                        break;case 'total_value':
                                            $vendorinvoices->orderBy('total_value', request('sortorder'));
                                            break;case 'status':
                                                $vendorinvoices->orderBy('status', request('sortorder'));
                                                break;                                                                                     }
        } else {
            //default sorting
            $vendorinvoices->orderBy(
                config('settings.ordering_vendorinvoices.sort_by'),
                config('settings.ordering_vendorinvoices.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $vendorinvoices->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$vendorinvoice = $this->vendorinvoices->find($id)) {
            Log::error("record could not be found", ['process' => '[VendorInvoiceRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'vendorinvoice_id' => $id ?? '']);
            return false;
        }

        //general
        // $vendorinvoice->rfq_ref = request('vendorinvoice_rfq_ref');
        // $vendorinvoice->receiving_date = request('vendorinvoice_receiving_date');
        // $vendorinvoice->category = request('vendorinvoice_category');
        // $vendorinvoice->invoice_ref_no = request('vendorinvoice_invoice_ref_no');
        // $vendorinvoice->total_value = request('vendorinvoice_total_value');
        // $vendorinvoice->devlivery_time = request('vendorinvoice_devlivery_time');
        // $vendorinvoice->upload_invoice_copy = request('vendorinvoice_upload_invoice_copy');
        // $vendorinvoice->upload_rfq_copy = request('vendorinvoice_upload_rfq_copy');
        $vendorinvoice->status = request('vendorinvoice_status');
        if(request('vendorinvoice_reason')){
            $vendorinvoice->reason = request('vendorinvoice_reason');
        }
    
        //save
        if ($vendorinvoice->save()) {
            $invoice = $vendorinvoice;
            if($invoice->status != 'Received For Authentication And Approval'){
                $user = User::find($invoice->user_id);
                Mail::to($user->email)->send(new VendorInvoiceMail($invoice));
            }
            return $vendorinvoice->id;
        } else {
            return false;
        }
    }


        /**
     * Create a new record
     * @return mixed int|bool project model object or false
     */
    public function create() {

        //save new user
        $vendorinvoice = new $this->vendorinvoices;

        $vendorinvoice->status = 'WAITING FOR APPROVAL';

    
        //save and return id
        if ($vendorinvoice->save()) {
            $invoice = $vendorinvoice;
            if($invoice->status != 'Received For Authentication And Approval'){
                $user = User::find($invoice->user_id);
                Mail::to($user->email)->send(new VendorInvoiceMail($invoice));
            }
            return $vendorinvoice->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[VendorInvoiceRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
