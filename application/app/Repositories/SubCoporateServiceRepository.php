<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for SubCoporateServiceRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\SubCorporateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class SubCoporateServiceRepository
{
    
    /**
     * The projects repository instance.
     */
    protected $subcorporateservice;

    /**
     * Inject dependecies
     */
    public function __construct(SubCorporateService $subcorporateservice)
    {
        $this->subcorporateservice = $subcorporateservice;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object CoporateServiceRepository collection
     */
    public function search($id = '', $data = [])
    {
        $subcorporateservice = $this->subcorporateservice->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        $subcorporateservice->selectRaw('*');

        //params: property id
        if (is_numeric($id)) {
            $subcorporateservice->where('id', $id);
        }
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $subcorporateservice->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('title','LIKE','%'.request('search_query').'%');
                $query->orWhere('description','LIKE','%'.request('search_query').'%');
                $query->orWhere('corporateservice_id','LIKE','%'.request('search_query').'%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //others
                    switch (request('orderby')) {
                    case 'id':
                    $subcorporateservice->orderBy('id', request('sortorder'));
                    break;
                    case 'title':
                    $subcorporateservice->orderBy('title', request('sortorder'));
                    break;
                    case 'description':
                    $subcorporateservice->orderBy('description', request('sortorder'));
                    break;           
                    case 'corporate_service':
                    $subcorporateservice->orderBy('corporate_service', request('sortorder'));
                    break;           
                    }
        } else {
            //default sorting
            $subcorporateservice->orderBy(
                config('settings.ordering_subcorporateservices.sort_by'),
                config('settings.ordering_subcorporateservices.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $subcorporateservice->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$subcorporateservice = $this->subcorporateservice->find($id)) {
            Log::error("record could not be found", ['process' => '[CoporateServiceRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'subcorporateservice_id' => $id ?? '']);
            return false;
        }
    
        $subcorporateservice->title = request('subcorporateservice_title');
        $subcorporateservice->description = request('subcorporateservice_description');
        $subcorporateservice->corporateservice_id = request('subcorporateservice_corporate_service');
        
    
        //save
        if ($subcorporateservice->save()) {
            return $subcorporateservice->id;
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
        $subcorporateservice = new $this->subcorporateservice;

        $subcorporateservice->title = request('subcorporateservice_title');
        $subcorporateservice->description = request('subcorporateservice_description');
        $subcorporateservice->corporateservice_id = request('subcorporateservice_corporate_service');
    
        //save and return id
        if ($subcorporateservice->save()) {
            return $subcorporateservice->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[CoporateServiceRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
