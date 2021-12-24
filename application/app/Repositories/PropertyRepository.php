<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\FrontEndProperty;
use App\Property;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class PropertyRepository
{
    /**
     * The properties repository instance.
     */
    protected $properties;

    /**
     * Inject dependecies
     */
    public function __construct(FrontEndProperty $properties)
    {
        $this->properties = $properties;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object property collection
     */
    public function search($id = '', $data = [])
    {
        $properties = $this->properties->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $properties->selectRaw('*');

        //params: property id
        if (is_numeric($id)) {
            $properties->where('id', $id);
        }


        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {

            $properties->where(function ($query) {
                $query->where('id', '=', request('search_query'));
                $query->orWhere('title', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('price', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('rent_or_sale', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('reference_no', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        //



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('properties', request('orderby'))) {
                $properties->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'title':
                    $properties->orderBy('title', request('sortorder'));
                    break;
                case 'price':
                    $properties->orderBy('price', request('sortorder'));
                    break;
                case 'rent_or_sale':
                    $properties->orderBy('rent_or_sale', request('sortorder'));
                    break;
                case 'reference_no':
                    $properties->orderBy('reference_no', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $properties->orderBy(
                config('settings.ordering_properties.sort_by'),
                config('settings.ordering_properties.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $properties->paginate($limit);
    }


    /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id)
    {
        //get the record
        if (!$property = $this->properties->find($id)) {
            Log::error("record could not be found", ['process' => '[PropertyRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        if (request()->property_status != null) {
            $property->status = request()->property_status;
        }
        //general
        $property->title = request('property_title');
        $property->description = request('property_description');


        //save
        if ($property->save()) {
            return $property->id;
        } else {
            return false;
        }
    }


    /**
     * Create a new record
     * @return mixed int|bool project model object or false
     */
    public function create()
    {

        //save new user
        $property = new $this->properties;

        //data
        $property->title = request('property_title');
        $property->description = request('property_description');


        //save and return id
        if ($property->save()) {
            return $property->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[PropertyRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }
}
