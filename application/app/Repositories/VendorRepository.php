<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Vendor;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class VendorRepository
{
    protected $vendors;
    public function __construct(Vendor $vendors)
    {
        $this->vendors = $vendors;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object Vendor collection
     */
    public function search($id = '', $data = [])
    {
        $vendors = $this->vendors->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $vendors->selectRaw('*');

        //params: Vendor id
        if (is_numeric($id)) {
            $vendors->where('id', $id);
        }

        // search
        //search: various client columns(where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {

            $vendors->where(function ($query) {
                $query->where('id', '=', request('search_query'));
                $query->orWhere('requestor', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('subject', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('request_date', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        // 



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('vendors', request('orderby'))) {
                $vendors->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'title':
                    $vendors->orderBy('title', request('sortorder'));
                    break;

                case 'rfq_ref':
                    $vendors->orderBy('rfq_ref', request('sortorder'));
                    break;
                
                case 'category':
                    $vendors->orderBy('category', request('sortorder'));
                    break;
                case 'priority':
                    $vendors->orderBy('priority', request('sortorder'));
                    break;

                case 'due_date_request':
                    $vendors->orderBy('due_date_request', request('sortorder'));
                    break;

                case 'required_quotation_validity':
                    $vendors->orderBy('required_quotation_validity', request('sortorder'));
                    break;

                case 'status':
                    $vendors->orderBy('status', request('sortorder'));
                    break;
                
            }
        } else {
            //default sorting
            $vendors->orderBy(
                config('settings.ordering_vendors.sort_by'),
                config('settings.ordering_vendors.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $vendors->paginate($limit);
    }
}
