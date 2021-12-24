<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Material;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class MaterialRepository
{
    /**
     * The materials repository instance.
     */
    protected $materials;

    /**
     * Inject dependecies
     */
    public function __construct(Material $materials)
    {
        $this->materials = $materials;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object material collection
     */
    public function search($id = '', $data = [])
    {

        $materials = $this->materials->newQuery();

        // dd($data);
        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $materials->selectRaw('*');

        //params: material id
        if (is_numeric($id)) {
            $materials->where('id', $id);
        }

        // //[data filter] - clients


        if ($data['apply_filters']) {

            if (request()->filled('material_category')) {
                $materials->where('category', request('material_category'));
            }
        }
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {

            $materials->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('title','LIKE','%'.request('search_query').'%');
                $query->orWhere('category','LIKE','%'.request('search_query').'%');
                $query->orWhere('amount','LIKE','%'.request('search_query').'%');
                $query->orWhere('available_stock','LIKE','%'.request('search_query').'%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('materials', request('orderby'))) {
                $materials->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $materials->orderBy('id', request('sortorder'));
                    break;
                case 'value':
                    $materials->orderBy('amount', request('sortorder'));
                    break;
                case 'title':
                    $materials->orderBy('title', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $materials->orderBy(
                config('settings.ordering_materials.sort_by'),
                config('settings.ordering_materials.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $materials->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$material = $this->materials->find($id)) {
            Log::error("record could not be found", ['process' => '[MaterialRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $material->title = request('material_title');
        $material->amount = request('material_value');
        $material->unit = request('material_unit');
        $material->available_stock = request('material_available_stock');
        $material->description = request('material_description');
        $material->category = request('material_category');


        //save
        if ($material->save()) {
            return $material->id;
        } else {
            return false;
        }
    }


        /**
     * Create a new record
     * @return mixed int|bool project model object or false
     */
    public function create() {

        //save new material
        $material = new $this->materials;

        //data
        $material->title = request('material_title');
        $material->amount = request('material_value');
        $material->available_stock = request('material_available_stock');
        $material->description = request('material_description');
        $material->category = request('material_category');


        //save and return id
        if ($material->save()) {
            return $material->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[MaterialRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
