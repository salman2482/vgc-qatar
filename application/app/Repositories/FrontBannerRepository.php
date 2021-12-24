<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for FrontBannerRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\FrontBanner;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class FrontBannerRepository
{
    /**
     * The frontbanner repository instance.
     */
    protected $frontbanner;

    /**
     * Inject dependecies
     */
    public function __construct(FrontBanner $frontbanner)
    {
        $this->frontbanner = $frontbanner;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object frontbanner collection
     */
    public function search($id = '', $data = [])
    {
        $frontbanner = $this->frontbanner->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }
        
        // select all
        $frontbanner->selectRaw('*');

        //params: frontbanner id
        if (is_numeric($id)) {
            $frontbanner->where('id', $id);
        }
    
        // search
        //search: various banner columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $frontbanner->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('title','LIKE','%'.request('search_query').'%');
                $query->orWhere('title_ar','LIKE','%'.request('search_query').'%');
                $query->orWhere('description','LIKE','%'.request('search_query').'%');
                $query->orWhere('description_ar','LIKE','%'.request('search_query').'%');
                
            });
        }

        // 



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column title
            if (Schema::hasColumn('frontbanner', request('orderby'))) {
                $frontbanner->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $frontbanner->orderBy('id', request('sortorder'));
                    break;
                
                    case 'title':
                    $frontbanner->orderBy('title', request('sortorder'));
                    break;

                    case 'description':
                    $frontbanner->orderBy('description', request('sortorder'));
                    break;

                    case 'title_ar':
                    $frontbanner->orderBy('title_ar', request('sortorder'));
                    break;

                    case 'description_ar':
                    $frontbanner->orderBy('description_ar', request('sortorder'));
                    break;

            }
        } else {
            //default sorting
            $frontbanner->orderBy(
                config('settings.ordering_frontbanners.sort_by'),
                config('settings.ordering_frontbanners.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $frontbanner->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$frontbanner = $this->frontbanner->find($id)) {
            Log::error("record could not be found", ['process' => '[FrontBannerRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $frontbanner->title = request('frontbanner_title');
        $frontbanner->title_ar = request('frontbanner_title_ar');
        $frontbanner->description = request('frontbanner_description');
        $frontbanner->description_ar = request('frontbanner_description_ar');

        //save
        if ($frontbanner->save()) {
            return $frontbanner->id;
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
        $frontbanner = new $this->frontbanner;

        //data
        $frontbanner->title = request('frontbanner_title');
        $frontbanner->title_ar = request('frontbanner_title_ar');
        $frontbanner->description = request('frontbanner_description');
        $frontbanner->description_ar = request('frontbanner_description_ar');

        //save and return id
        if ($frontbanner->save()) {
            return $frontbanner->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[FrontBannerRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
