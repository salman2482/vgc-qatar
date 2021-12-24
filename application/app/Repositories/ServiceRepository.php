<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class ServiceRepository
{
    /**
     * The contracts repository instance.
     */
    protected $services;

    /**
     * Inject dependecies
     */
    public function __construct(Service $services)
    {
        $this->services = $services;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object property collection
     */
    public function search($id = '', $data = [])
    {
        $services = $this->services->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        //params: contract id
        if (is_numeric($id)) {
            $services->where('id', $id);
        }

        // search
        if (request()->filled('search_query') || request()->filled('query')) {

            $services->where(function ($query) {
                $query->where('id', '=', request('search_query'));
                $query->orWhere('title', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        //
        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('services', request('orderby'))) {
                $services->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $services->orderBy('id', request('sortorder'));
                    break;
                case 'title':
                    $services->orderBy('title', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $services->orderBy(
                config('settings.ordering_services.sort_by'),
                config('settings.ordering_services.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $services->paginate($limit);
    }


    /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id)
    {
        //get the record
        if (!$service = $this->services->find($id)) {
            Log::error("record could not be found", ['process' => '[ServiceRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        if (request()->hasFile('service_image')) {
            if($service->image != ""){
                Storage::delete('public/service_image/'.$service->image);
             }

            $file = request()->file('service_image');
            $fileName = $file->getClientOriginalName();
            Storage::put('public/service_image/'.$fileName,file_get_contents($file));
            $service->image = $fileName;
        }


        $description = [];
        $prices = [];
        for ($i = 0; $i <= count(request('description')); $i++) {
            if (!empty(request()->description[$i])) {
                array_push($description,request()->description[$i]);
                array_push($prices,request()->price[$i]);
            }
        }
        //general
        $service->title = request('service_title');
        $service->description = implode('&&&', $description);
        $service->price = implode('&&&', $prices);
        $service->rate_per_hour = request('rate_per_hour');
        $service->minimum_charge = request('minimum_charge');
        $service->service_description = request('service_description');

        //save
        if ($service->save()) {
            return $service->id;
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
        $description = [];
        $prices = [];
        //foreach()
        for ($i = 0; $i <= count(request('description')); $i++) {
            if (!empty(request()->description[$i])) {
                array_push($description,request()->description[$i]);
                array_push($prices,request()->price[$i]);
            }
        }
        //save new user
        $service = new Service();
        $fileName = null;
        if (request()->hasFile('service_image')) {
            $file = request()->file('service_image');
            $fileName = time() . $file->getClientOriginalName();
            Storage::put('public/service_image/' . $fileName, file_get_contents($file));
        }

        $service->title = request('service_title');
        $service->description = implode('&&&', $description);
        $service->price = implode('&&&', $prices);
        $service->rate_per_hour = request('rate_per_hour');
        $service->minimum_charge = request('minimum_charge');
        $service->service_description = request('service_description');
        $service->image = $fileName ?? '';
        //save and return id
        if ($service->save()) {
            return $service->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[ServiceRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }
}
