<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for FrontCareerRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\FrontCareer;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class FrontCareerRepository
{
    /**
     * The frontcareers repository instance.
     */
    protected $frontcareers;

    /**
     * Inject dependecies
     */
    public function __construct(FrontCareer $frontcareers)
    {
        $this->frontcareers = $frontcareers;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object frontcareer collection
     */
    public function search($id = '', $data = [])
    {
        $frontcareers = $this->frontcareers->newQuery();
        
        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }
        
        // select all
        $frontcareers->selectRaw('*');

        //params: frontcareer id
        if (is_numeric($id)) {
            $frontcareers->where('id', $id);
        }
    
        // search
        //search: various career columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $frontcareers->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('title','LIKE','%'.request('search_query').'%');
                $query->orWhere('experience','LIKE','%'.request('search_query').'%');
                $query->orWhere('category','LIKE','%'.request('search_query').'%');
                $query->orWhere('position','LIKE','%'.request('search_query').'%');
                $query->orWhere('salary','LIKE','%'.request('search_query').'%');
                $query->orWhere('status','LIKE','%'.request('search_query').'%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('frontcareers', request('orderby'))) {
                $frontcareers->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $frontcareers->orderBy('id', request('sortorder'));
                    break;
                
                    case 'title':
                    $frontcareers->orderBy('title', request('sortorder'));
                    break;

                    case 'experience':
                    $frontcareers->orderBy('experience', request('sortorder'));
                    break;
                    
                    case 'category':
                    $frontcareers->orderBy('category', request('sortorder'));
                    break;
                    
                    case 'salary':
                    $frontcareers->orderBy('salary', request('sortorder'));
                    break;
                    
                    case 'position':
                    $frontcareers->orderBy('position', request('sortorder'));
                    break;

                    case 'status':
                    $frontcareers->orderBy('status', request('sortorder'));
                    break;

            }
        } else {
            //default sorting
            $frontcareers->orderBy(
                config('settings.ordering_frontcareers.sort_by'),
                config('settings.ordering_frontcareers.sort_order')
            );
        }

       // Get the results and return them.
       if (isset($data['limit']) && is_numeric($data['limit'])) {
        $limit = $data['limit'];
    } else {
        $limit = config('system.settings_system_pagination_limits');
    }

    return $frontcareers->paginate($limit);
    }

     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$frontcareer = $this->frontcareers->find($id)) {
            Log::error("record could not be found", ['process' => '[FrontCareerRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $frontcareer->title = request('frontcareer_title');
        $frontcareer->experience = request('frontcareer_experience');
        $frontcareer->category = request('frontcareer_category');
        $frontcareer->salary = request('frontcareer_salary');
        $frontcareer->position = request('frontcareer_position');
        $frontcareer->status = request('frontcareer_status');

        //save
        if ($frontcareer->save()) {
            return $frontcareer->id;
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
        $frontcareer = new $this->frontcareers;

        //data
        $frontcareer->title = request('frontcareer_title');
        $frontcareer->experience = request('frontcareer_experience');
        $frontcareer->category = request('frontcareer_category');
        $frontcareer->salary = request('frontcareer_salary');
        $frontcareer->position = request('frontcareer_position');
        $frontcareer->status = request('frontcareer_status');

        //save and return id
        if ($frontcareer->save()) {
            return $frontcareer->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[FrontCareerRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
