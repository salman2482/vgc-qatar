<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for SubProductRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\SubProduct;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class SubProductRepository
{
    
    /**
     * The projects repository instance.
     */
    protected $subproduct;

    /**
     * Inject dependecies
     */
    public function __construct(SubProduct $subproduct)
    {
        $this->subproduct = $subproduct;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object SubProductRepository collection
     */
    public function search($id = '', $data = [])
    {
        $subproduct = $this->subproduct->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        $subproduct->selectRaw('*');

        //params: property id
        if (is_numeric($id)) {
            $subproduct->where('id', $id);
        }
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $subproduct->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('title','LIKE','%'.request('search_query').'%');
                $query->orWhere('description','LIKE','%'.request('search_query').'%');
                $query->orWhere('f_product_id','LIKE','%'.request('search_query').'%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //others
                    switch (request('orderby')) {
                    case 'id':
                    $subproduct->orderBy('id', request('sortorder'));
                    break;
                    case 'title':
                    $subproduct->orderBy('title', request('sortorder'));
                    break;
                    case 'description':
                    $subproduct->orderBy('description', request('sortorder'));
                    break;           
                    case 'f_product':
                    $subproduct->orderBy('f_product', request('sortorder'));
                    break;           
                    }
        } else {
            //default sorting
            $subproduct->orderBy(
                config('settings.ordering_subproducts.sort_by'),
                config('settings.ordering_subproducts.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $subproduct->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$subproduct = $this->subproduct->find($id)) {
            Log::error("record could not be found", ['process' => '[SubProductRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'subf_product_id' => $id ?? '']);
            return false;
        }
    
        $subproduct->title = request('subproduct_title');
        $subproduct->description = request('subproduct_description');
        $subproduct->f_product_id = request('subproduct_f_product');
        $subproduct->status = request('fproduct_status');
    
        //save
        if ($subproduct->save()) {
            return $subproduct->id;
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
        $subproduct = new $this->subproduct;

        $subproduct->title = request('subproduct_title');
        $subproduct->description = request('subproduct_description');
        $subproduct->f_product_id = request('subproduct_f_product');
        $subproduct->status = request('fproduct_status');
        //save and return id
        if ($subproduct->save()) {
            return $subproduct->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[SubProductRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
