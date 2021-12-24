<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\EmailList;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;


class MailListRepository
{
    /**
     * The properties repository instance.
     */
    protected $mails;

    /**
     * Inject dependecies
     */
    public function __construct(EmailList $mails)
    {
        $this->mails = $mails;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object property collection
     */
    public function search($id = '', $data = [])
    {
        $mails = $this->mails->newQuery();
        // select all

        $mails->selectRaw('*');

        //params: property id
        if (is_numeric($id)) {
            $mails->where('id', $id);
        }


        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
            $mails->where(function ($query) {
                $query->where('email', 'LIKE', '%' . request('search_query') . '%');
            });
        }



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('emails_list', request('orderby'))) {
                $mails->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $mails->orderBy('id', request('sortorder'));
                    break;
                case 'email':
                    $mails->orderBy('email', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $mails->orderBy(
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

        return $mails->paginate($limit);
    }


    /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id)
    {
        //get the record
        if (!$property = $this->mails->find($id)) {
            Log::error("record could not be found", ['process' => '[MailListRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
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
        $mail = new $this->mails;

        //data
        $mail->email = request('email');


        //save and return id
        if ($mail->save()) {
            return $mail->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[MailListRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }
}
