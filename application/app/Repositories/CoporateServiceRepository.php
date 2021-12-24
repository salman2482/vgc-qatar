<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for CoporateServiceRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\CorporateService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class CoporateServiceRepository
{
    
    /**
     * The projects repository instance.
     */
    protected $corporateservice;

    /**
     * Inject dependecies
     */
    public function __construct(CorporateService $corporateservice)
    {
        $this->corporateservice = $corporateservice;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object CoporateServiceRepository collection
     */
    public function search($id = '', $data = [])
    {
        $corporateservice = $this->corporateservice->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $corporateservice->selectRaw('*');

        //params: property id
        if (is_numeric($id)) {
            $corporateservice->where('id', $id);
        }
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $corporateservice->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('title','LIKE','%'.request('search_query').'%');
                $query->orWhere('description','LIKE','%'.request('search_query').'%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //others
                    switch (request('orderby')) {
                    case 'id':
                    $corporateservice->orderBy('id', request('sortorder'));
                    break;
                    case 'title':
                    $corporateservice->orderBy('title', request('sortorder'));
                    break;
                    case 'description':
                    $corporateservice->orderBy('description', request('sortorder'));
                               
                    }
        } else {
            //default sorting
            $corporateservice->orderBy(
                config('settings.ordering_corporateservices.sort_by'),
                config('settings.ordering_corporateservices.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $corporateservice->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$corporateservice = $this->corporateservice->find($id)) {
            Log::error("record could not be found", ['process' => '[CoporateServiceRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'corporateservice_id' => $id ?? '']);
            return false;
        }
    
        $corporateservice->title = request('corporateservice_title');
        $corporateservice->description = request('corporateservice_description');
        
    
        //save
        if ($corporateservice->save()) {
            return $corporateservice->id;
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
        $corporateservice = new $this->corporateservice;

        $corporateservice->title = request('corporateservice_title');
        $corporateservice->description = request('corporateservice_description');
    
        //save and return id
        if ($corporateservice->save()) {
            return $corporateservice->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[CoporateServiceRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
