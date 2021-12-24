<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\GovtDocument;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class GovtDocumentRepository
{
    /**
     * The projects repository instance.
     */
    protected $govtdocuments;

    /**
     * Inject dependecies
     */
    public function __construct(GovtDocument $govtdocuments)
    {
        $this->govtdocuments = $govtdocuments;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object govtdocument collection
     */
    public function search($id = '', $data = [])
    {
        $govtdocuments = $this->govtdocuments->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $govtdocuments->selectRaw('*');

        //params: govtdocument id
        if (is_numeric($id)) {
            $govtdocuments->where('id', $id);
        }


        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $govtdocuments->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('type_of_document','LIKE','%'.request('search_query').'%');
                $query->orWhere('doc_no','LIKE','%'.request('search_query').'%');
                $query->orWhere('issue_date','LIKE','%'.request('search_query').'%');
                $query->orWhere('validity_date','LIKE','%'.request('search_query').'%');
                $query->orWhere('renewal_cost','LIKE','%'.request('search_query').'%');
                $query->orWhere('last_renewal_by','LIKE','%'.request('search_query').'%');
                $query->orWhere('document_copy','LIKE','%'.request('search_query').'%');
                $query->orWhere('last_renewal_copy','LIKE','%'.request('search_query').'%');
                $query->orWhere('status','LIKE','%'.request('search_query').'%');
            });
        }

        // 


        // dd(request('sortorder'));

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //others
            switch (request('orderby')) {
                case 'id':
                    $govtdocuments->orderBy('id', request('sortorder'));
                    break;
                    case 'type_of_document':
                        $govtdocuments->orderBy('type_of_document', request('sortorder'));
                        break;
                        case 'doc_no':
                            $govtdocuments->orderBy('doc_no', request('sortorder'));
                            break;
                            case 'issue_date':
                                $govtdocuments->orderBy('issue_date', request('sortorder'));
                                break;
                                case 'validity_date':
                                    $govtdocuments->orderBy('validity_date', request('sortorder'));
                                    break;
                                    case 'renewal_cost':
                                        $govtdocuments->orderBy('renewal_cost', request('sortorder'));
                                        break;
                                        case 'last_renewal_by':
                                            $govtdocuments->orderBy('last_renewal_by', request('sortorder'));
                                            break;
                                            case 'document_copy':
                                                $govtdocuments->orderBy('document_copy', request('sortorder'));
                                                break;
                                                case 'last_renewal_copy':
                                                    $govtdocuments->orderBy('last_renewal_copy', request('sortorder'));
                                                    break;
                                                    case 'status':
                                                        $govtdocuments->orderBy('status', request('sortorder'));
                                                        break;
                                                                                                                                                            }
        } else {
            //default sorting
            $govtdocuments->orderBy(
                config('settings.ordering_govtdocuments.sort_by'),
                config('settings.ordering_govtdocuments.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $govtdocuments->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$govtdocument = $this->govtdocuments->find($id)) {
            Log::error("record could not be found", ['process' => '[GovtDocumentRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'govtdocument_id' => $id ?? '']);
            return false;
        }

        //general
        $govtdocument->type_of_document = request('govtdocument_type_of_document');
        $govtdocument->doc_no	 = request('govtdocument_doc_no');
        $govtdocument->issue_date = request('govtdocument_issue_date');
        $govtdocument->validity_date = request('govtdocument_validity_date');
        $govtdocument->renewal_cost = request('govtdocument_renewal_cost');
        $govtdocument->last_renewal_by = request('govtdocument_last_renewal_by');
        $govtdocument->document_copy = request('govtdocument_document_copy');
        $govtdocument->last_renewal_copy = request('govtdocument_last_renewal_copy');
        $govtdocument->status = request('govtdocument_status');
    
        //save
        if ($govtdocument->save()) {
            return $govtdocument->id;
        } else {
            return false;
        }
    }


        /**
     * Create a new record
     * @return mixed int|bool project model object or false
     */
    public function create() {

      //  dd(request('govtdocument_doc_no'));
        //save new user
        $govtdocument = new $this->govtdocuments;
        //data
        $govtdocument->type_of_document = request('govtdocument_type_of_document');
        $govtdocument->doc_no	 = request('govtdocument_doc_no');
        $govtdocument->issue_date = request('govtdocument_issue_date');
        $govtdocument->validity_date = request('govtdocument_validity_date');
        $govtdocument->renewal_cost = request('govtdocument_renewal_cost');
        $govtdocument->last_renewal_by = request('govtdocument_last_renewal_by');
        $govtdocument->document_copy = request('govtdocument_document_copy');
        $govtdocument->last_renewal_copy = request('govtdocument_last_renewal_copy');
        $govtdocument->status = request('govtdocument_status');
    
        
    
        //save and return id
        if ($govtdocument->save()) {
            return $govtdocument->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[GovtDocumentRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
