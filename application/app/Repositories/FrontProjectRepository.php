<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for FrontProjectRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\FrontProject;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class FrontProjectRepository
{
    /**
     * The frontprojects repository instance.
     */
    protected $frontprojects;

    /**
     * Inject dependecies
     */
    public function __construct(FrontProject $frontprojects)
    {
        $this->frontprojects = $frontprojects;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object frontproject collection
     */
    public function search($id = '', $data = [])
    {
        $frontprojects = $this->frontprojects->newQuery();

        // dd($frontprojects); 
         
        
        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }
        
        // select all
        
        $frontprojects->selectRaw('*');
        
        $frontprojects->whereNotIn('contractor', ['addImgDesc']);
        
        //params: frontproject id
        if (is_numeric($id)) {
            $frontprojects->where('id', $id);
        }

    
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $frontprojects->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('title','LIKE','%'.request('search_query').'%');
                $query->orWhere('contractor','LIKE','%'.request('search_query').'%');
                $query->orWhere('client','LIKE','%'.request('search_query').'%');
                $query->orWhere('status','LIKE','%'.request('search_query').'%');
            });
        }

        // 



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('frontprojects', request('orderby'))) {
                $frontprojects->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $frontprojects->orderBy('id', request('sortorder'));
                    break;
                case 'title':
                    $frontprojects->orderBy('title', request('sortorder'));
                    break;

                    case 'contractor':
                    $frontprojects->orderBy('contractor', request('sortorder'));
                    break;

                    case 'client':
                    $frontprojects->orderBy('client', request('sortorder'));
                    break;

                    case 'status':
                    $frontprojects->orderBy('status', request('sortorder'));
                    break;

            }
        } else {
            //default sorting
            $frontprojects->orderBy(
                config('settings.ordering_frontprojects.sort_by'),
                config('settings.ordering_frontprojects.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $frontprojects->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$frontproject = $this->frontprojects->find($id)) {
            Log::error("record could not be found", ['process' => '[FrontProjectRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $frontproject->title = request('frontproject_title');
        $frontproject->contractor = request('frontproject_contractor');
        $frontproject->client = request('frontproject_client');
        $frontproject->status = request('frontproject_status');
        $frontproject->project_image = 'no image';
       

        //save
        if ($frontproject->save()) {
            return $frontproject->id;
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
        $frontproject = new $this->frontprojects;

        //data
        $frontproject->title = request('frontproject_title');
        $frontproject->contractor = request('frontproject_contractor');
        $frontproject->client = request('frontproject_client');
        $frontproject->status = request('frontproject_status');
        $frontproject->project_image = 'no image';
       
    
        //save and return id
        if ($frontproject->save()) {
            return $frontproject->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[FrontProjectRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
