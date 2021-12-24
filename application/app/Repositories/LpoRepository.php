<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for lpos
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\LpoMgt;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class LpoRepository
{
    /**
     * The contracts repository instance.
     */
    protected $lpos;

    /**
     * Inject dependecies
     */
    public function __construct(LpoMgt $lpos)
    {
        $this->lpos = $lpos;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object lpo collection
     */
    public function search($id = '', $data = [])
    {
        $lpos = $this->lpos->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $lpos->selectRaw('*');

        //params: lpo id
        if (is_numeric($id)) {
            $lpos->where('id', $id);
        }

        // search
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $lpos->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('ref_no','LIKE','%'.request('search_query').'%');
                $query->orWhere('department','LIKE','%'.request('search_query').'%');
                $query->orWhere('rfm_ref_no','LIKE','%'.request('search_query').'%');
                $query->orWhere('value','LIKE','%'.request('search_query').'%');
                $query->orWhere('requestor','LIKE','%'.request('search_query').'%');
                $query->orWhere('site','LIKE','%'.request('search_query').'%');
            });
        }

        // 



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('lpo_mgts', request('orderby'))) {
                $lpos->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'ref_no':
                    $lpos->orderBy('ref_no', request('sortorder'));
                    break;
                case 'department':
                    $lpos->orderBy('department', request('sortorder'));
                    break;
                case 'rfm_ref_no':
                    $lpos->orderBy('rfm_ref_no', request('sortorder'));
                    break;
                case 'value':
                    $lpos->orderBy('value', request('sortorder'));
                    break;
                case 'requestor':
                    $lpos->orderBy('requestor', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $lpos->orderBy(
                config('settings.ordering_lpos.sort_by'),
                config('settings.ordering_lpos.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $lpos->paginate($limit);
    }


     /**
     * update a record
     * @param int $id lpo id
     * @return mixed int|bool  lpo id or false
     */
    public function update($id) {

        //get the record
        if (!$lpo = $this->lpos->find($id)) {
            Log::error("record could not be found", ['process' => '[LpoRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'id' => $id ?? '']);
            return false;
        }

        //general
        $lpo->rfm_ref_no = request('rfm_ref_no');
        $lpo->department = request('department');
        $lpo->subject = request('subject');
        $lpo->site = request('site');
        $lpo->value = request('value');
        $lpo->date_requested = request('date_requested');
        $lpo->requestor = request('requestor');    
        $lpo->remarks = request('remarks');       

        //save
        if ($lpo->save()) {
            return $lpo->id;
        } else {
            return false;
        }
    }


        /**
     * Create a new record
     * @return mixed int|bool lpo model object or false
     */
    public function create() {

        //save new user
        $lpo = new $this->lpos;
        //data
        $lpo->ref_no = '#lpo-ref-'.Str::random(5) ;
        $lpo->rfm_ref_no = request('rfm_ref_no');
        $lpo->department = request('department');
        $lpo->subject = request('subject');
        $lpo->site = request('site');
        $lpo->value = request('value');
        $lpo->date_requested = request('date_requested');
        $lpo->requestor = request('requestor');       
        $lpo->remarks = request('remarks');       
    
        //save and return id
        if ($lpo->save()) {
            return $lpo->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[LpoRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
