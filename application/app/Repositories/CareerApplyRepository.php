<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for CareerApplyRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\CareerApply;
use App\Models\FrontCareer;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class CareerApplyRepository
{
    /**
     * The careersapply repository instance.
     */
    protected $careersapply;

    /**
     * Inject dependecies
     */
    public function __construct(CareerApply $careersapply)
    {
        $this->careersapply = $careersapply;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object careerapply collection
     */
    public function search($id = '', $data = [])
    {
        $careersapply = $this->careersapply->newQuery();
        
        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }
        
        // select all
        $careersapply->selectRaw('*');

        //params: careerapply id
        if (is_numeric($id)) {
            $careersapply->where('id', $id);
        }
    
        // search
        //search: various career columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $careersapply->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('type','LIKE','%'.request('search_query').'%');
                $query->orWhere('field','LIKE','%'.request('search_query').'%');
                $query->orWhere('first_name','LIKE','%'.request('search_query').'%');
                $query->orWhere('primary_email','LIKE','%'.request('search_query').'%');
                $query->orWhere('mobile','LIKE','%'.request('search_query').'%');
                $query->orWhere('education','LIKE','%'.request('search_query').'%');
                $query->orWhere('nationality','LIKE','%'.request('search_query').'%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('careersapply', request('orderby'))) {
                $careersapply->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $careersapply->orderBy('id', request('sortorder'));
                    break;
                
                    case 'type':
                    $careersapply->orderBy('type', request('sortorder'));
                    break;

                    case 'field':
                    $careersapply->orderBy('field', request('sortorder'));
                    break;
                    
                    case 'first_name':
                    $careersapply->orderBy('first_name', request('sortorder'));
                    break;
                    
                    case 'primary_email':
                    $careersapply->orderBy('primary_email', request('sortorder'));
                    break;

                    case 'mobile':
                    $careersapply->orderBy('mobile', request('sortorder'));
                    break;

                    case 'education':
                    $careersapply->orderBy('education', request('sortorder'));
                    break;
                    
                    case 'nationality':
                    $careersapply->orderBy('nationality', request('sortorder'));
                    break;

            }
        } else {
            //default sorting
            $careersapply->orderBy(
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

   
    return $careersapply->paginate($limit);
    }

     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$careerapply = $this->careersapply->find($id)) {
            Log::error("record could not be found", ['process' => '[CareerApplyRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $careerapply->title = request('frontcareer_title');
        $careerapply->experience = request('frontcareer_experience');
        $careerapply->category = request('frontcareer_category');
        $careerapply->salary = request('frontcareer_salary');
        $careerapply->status = request('frontcareer_status');

        //save
        if ($careerapply->save()) {
            return $careerapply->id;
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
        $careerapply = new $this->careersapply;

        //data
        $careerapply->title = request('frontcareer_title');
        $careerapply->experience = request('frontcareer_experience');
        $careerapply->category = request('frontcareer_category');
        $careerapply->salary = request('frontcareer_salary');
        $careerapply->status = request('frontcareer_status');

        //save and return id
        if ($careerapply->save()) {
            return $careerapply->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[CareerApplyRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
