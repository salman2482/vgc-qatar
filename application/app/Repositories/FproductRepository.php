<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for fproduct
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\FProduct;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class FproductRepository
{
    /**
     * The fproducts repository instance.
     */
    protected $fproducts;

    /**
     * Inject dependecies
     */
    public function __construct(FProduct $fproducts)
    {
        $this->fproducts = $fproducts;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object fproduct collection
     */
    public function search($id = '', $data = [])
    {
        $fproducts = $this->fproducts->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $fproducts->selectRaw('*');

        //params: fproduct id
        if (is_numeric($id)) {
            $fproducts->where('id', $id);
        }

        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $fproducts->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('title','LIKE','%'.request('search_query').'%');
                $query->orWhere('description','LIKE','%'.request('search_query').'%');
                $query->orWhere('status','LIKE','%'.request('search_query').'%');
            });
        }

        // 



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('fproducts', request('orderby'))) {
                $fproducts->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'title':
                $fproducts->orderBy('title', request('sortorder'));
                break;

                case 'status':
                $fproducts->orderBy('status', request('sortorder'));
                break;
            }
        } else {
            //default sorting
            $fproducts->orderBy(
                config('settings.ordering_fproducts.sort_by'),
                config('settings.ordering_fproducts.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $fproducts->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$fproduct = $this->fproducts->find($id)) {
            Log::error("record could not be found", ['process' => '[FproductRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $fproduct->title = request('fproduct_title');
        $fproduct->description = request('fproduct_description');
        $fproduct->f_category_id = request('fproduct_category');

        //save
        if ($fproduct->save()) {
            return $fproduct->id;
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
        $fproduct = new $this->fproducts;

        //data
        $fproduct->title = request('fproduct_title');
        $fproduct->description = request('fproduct_description');
        $fproduct->f_category_id = request('fproduct_category');
    
        //save and return id
        if ($fproduct->save()) {
            return $fproduct->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[FproductRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
