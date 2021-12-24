<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RItemRepository;
use App\Http\Responses\RItems\EditResponse;
use App\Http\Responses\RItems\IndexResponse;
use App\Http\Responses\RItems\StoreResponse;
use App\Http\Responses\RItems\CreateResponse;
use App\Http\Responses\RItems\UpdateResponse;
use App\Http\Responses\RItems\DestroyResponse;

class RItems extends Controller
{
    /**
     * The ritem repository instance.
     */
    protected $ritemrepo;

    public function __construct(RItemRepository $ritemrepo)
    {
        //parent
        parent::__construct();

        $this->ritemrepo = $ritemrepo;
        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('propertiesMiddlewareIndex')->only([
            'index',
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get team ritems
         $ritems = $this->ritemrepo->search();

         //reponse payload
         $payload = [
             'page' => $this->pageSettings('ritems'),
             'ritems' => $ritems,
         ];
 
         //show the view
         return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ritem = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'ritem' => $ritem,
        ];

        //show the form
        return new CreateResponse($payload);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //create the property
         $error = $request->validate([
            'ritem_uom' => 'required|integer',
            'ritem_qty' => 'required|integer',
            'ritem_description' => 'required',
         ]);
         
         if($error){
             return  $message = 'there is an error';
         }

         if (!$ritem_id = $this->ritemrepo->create()) {
            abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $ritems = $this->ritemrepo->search($ritem_id);

        //counting all rows
        $rows = $this->ritemrepo->search();
        $count = $rows->count();
        //reponse payload
        $payload = [
            'count' => $count,
            'ritems' => $ritems,
        ];


        //process reponse
        return new StoreResponse($payload);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ritems = $this->ritemrepo->search($id);
        $ritem = $ritems->first();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'ritem' => $ritem,
        ];
        return new EditResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           //get project
           $ritems = $this->ritemrepo->search($id);
           $ritem = $ritems->first();
           //update
           if (!$this->ritemrepo->update($id)) {
               abort(409);
           }
   
           //get project
           $ritems = $this->ritemrepo->search($id);
           $ritem = $ritems->first();
           //reponse payload
           $payload = [
               'ritems' => $ritems,
               'id' => $id,
           ];
   
           //generate a response
           return new UpdateResponse($payload);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //delete each record in the array
        //get record
        if (!\App\Models\RItems::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $ritems = $this->ritemrepo->search($id);
        $ritem = $ritems->first();

        //delete the category
        $ritem->delete();

        //reponse payload
        $payload = [
            'id' => $id,
        ];

        //generate a response
        return new DestroyResponse($payload);
    }


       /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = [])
    {

        //common settings
        $page = [
            'crumbs' => [
                __('RItems'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'ritems',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_vendors' => 'active',
            'submenu_ritems' => 'active',
            'mainmenu_ritems' => 'active',
            'sidepanel_id' => 'sidepanel-filter-ritems',
            'dynamic_search_url' => url('ritems/search?action=search&ritemresource_id=' . request('ritemresource_id') . '&ritemresource_type=' . request('ritemresource_type')),
            'add_button_classes' => 'add-edit-ritems-button',
            'load_more_button_route' => 'ritems',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => 'Add RItem',
            'add_modal_create_url' => url('ritems/create?ritemresource_id=' . request('ritemresource_id') . '&ritemresource_type=' . request('ritemresource_type')),
            'add_modal_action_url' => url('ritems?ritemresource_id=' . request('ritemresource_id') . '&ritemresource_type=' . request('ritemresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'ritems') {
            $page += [
                'meta_title' => __('RItems'),
                'heading' => __('RItems'),
                'sidepanel_id' => 'sidepanel-filter-ritems',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        
        //ext page settings
        if ($section == 'ext') {
            $page += [
                'list_page_actions_size' => 'col-lg-12',

            ];
            return $page;
        }

        //create new resource
        if ($section == 'create') {
            $page += [
                'section' => 'create',
            ];
            return $page;
        }

        //edit new resource
        if ($section == 'edit') {
            $page += [
                'section' => 'edit',
            ];
            return $page;
        }

        //return
        return $page;
    }
}
