<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for FrontClientRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\FrontClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class FrontClientRepository
{
    /**
     * The frontclients repository instance.
     */
    protected $frontclients;

    /**
     * Inject dependecies
     */
    public function __construct(FrontClient $frontclients)
    {
        $this->frontclients = $frontclients;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object frontclient collection
     */
    public function search($id = '', $data = [])
    {
        $frontclients = $this->frontclients->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }
        
        // select all
        $frontclients->selectRaw('*');

        //params: frontclient id
        if (is_numeric($id)) {
            $frontclients->where('id', $id);
        }
    
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $frontclients->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('name','LIKE','%'.request('search_query').'%');
                $query->orWhere('description','LIKE','%'.request('search_query').'%');
                
            });
        }

        // 



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('frontclients', request('orderby'))) {
                $frontclients->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $frontclients->orderBy('id', request('sortorder'));
                    break;
                
                    case 'name':
                    $frontclients->orderBy('name', request('sortorder'));
                    break;

                    case 'description':
                    $frontclients->orderBy('description', request('sortorder'));
                    break;

            }
        } else {
            //default sorting
            $frontclients->orderBy(
                config('settings.ordering_frontclients.sort_by'),
                config('settings.ordering_frontclients.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $frontclients->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$frontclient = $this->frontclients->find($id)) {
            Log::error("record could not be found", ['process' => '[FrontClientRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $frontclient->name = request('frontclient_name');
        $frontclient->description = request('frontclient_description');

        //save
        if ($frontclient->save()) {
            return $frontclient->id;
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
        $frontclient = new $this->frontclients;

        //data
        $frontclient->name = request('frontclient_name');
        $frontclient->description = request('frontclient_description');

        //save and return id
        if ($frontclient->save()) {
            return $frontclient->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[FrontClientRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
