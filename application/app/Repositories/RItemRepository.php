<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\RItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class RItemRepository
{
    /**
     * The rf items repository instance.
     */
    protected $ritems;

    /**
     * Inject dependecies
     */
    public function __construct(RItem $ritems)
    {
        $this->ritems = $ritems;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object ritem collection
     */
    public function search($id = '', $data = [])
    {
        $ritems = $this->ritems->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $ritems->selectRaw('*');

        //params: ritem id
        if (is_numeric($id)) {
            $ritems->where('id', $id);
        }

        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $ritems->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('uom','LIKE','%'.request('search_query').'%');
                $query->orWhere('qty','LIKE','%'.request('search_query').'%');
                $query->orWhere('description','LIKE','%'.request('search_query').'%');
            });
        }

        // 



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('ritems', request('orderby'))) {
                $ritems->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $ritems->orderBy('id', request('sortorder'));
                    break;
                case 'uom':
                    $ritems->orderBy('uom', request('sortorder'));
                    break;
                case 'qty':
                    $ritems->orderBy('qty', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $ritems->orderBy(
                config('settings.ordering_ritems.sort_by'),
                config('settings.ordering_ritems.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $ritems->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$ritem = $this->ritems->find($id)) {
            Log::error("record could not be found", ['process' => '[RItemRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $ritem->uom = request('ritem_uom');
        $ritem->qty = request('ritem_qty');
        $ritem->description = request('ritem_description');
       

        //save
        if ($ritem->save()) {
            return $ritem->id;
        } else {
            return false;
        }
    }


        /**
     * Create a new record
     * @return mixed int|bool project model object or false
     */
    public function create() {

        //save new ritem
        $ritem = new $this->ritems;

        //data
        $ritem->uom = request('ritem_uom');
        $ritem->qty = request('ritem_qty');
        $ritem->description = request('ritem_description');
       
    
        //save and return id
        if ($ritem->save()) {
            return $ritem->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[RItemRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
