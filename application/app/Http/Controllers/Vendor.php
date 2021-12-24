<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\VendorRepository;

class Vendor extends Controller
{
    protected $vendorrepo;
    public function __construct(VendorRepository $vendorrepo) {
        //parent
        parent::__construct();

        $this->vendorrepo = $vendorrepo;

          //authenticated
          $this->middleware('auth');
          //Permissions on methods
        $this->middleware('vendorsMiddlewareIndex')->only([
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
        $vendors = $this->vendorrepo->search();
         //reponse payload
         $payload = [
            'page' => $this->pageSettings('vendors'),
            'vendors' => $vendors,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // page settings
     /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.vendors'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'vendors',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_vendors' => 'active',
            'sidepanel_id' => 'sidepanel-filter-vendors',
            'dynamic_search_url' => url('vendors/search?action=search&vendorresource_id=' . request('vendorresource_id') . '&vendorresource_type=' . request('vendorresource_type')),
            'add_button_classes' => 'add-edit-vendors-button',
            'load_more_button_route' => 'vendors',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_vendor'),
            'add_modal_create_url' => url('vendors/create?vendorresource_id=' . request('vendorresource_id') . '&vendorresource_type=' . request('vendorresource_type')),
            'add_modal_action_url' => url('vendors?vendorresource_id=' . request('vendorresource_id') . '&vendorresource_type=' . request('vendorresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'vendors') {
            $page += [
                'meta_title' => __('lang.vendors'),
                'heading' => __('lang.vendors'),
                'sidepanel_id' => 'sidepanel-filter-vendors',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //vendor page
        // if ($section == 'property') {
        //     //adjust
        //     $page['page'] = 'property';

        //     //crumbs
        //     $page['crumbs'] = [
        //         __('lang.property'),
        //         '#' . $data->id,
        //     ];

        //     //add
        //     $page += [
        //         'crumbs_special_class' => 'main-pages-crumbs',
        //         'meta_title' => __('lang.properties') . ' - ' . $data->title,
        //         'heading' => $data->title,
        //         'id' => request()->segment(2),
        //         'source_for_filter_panels' => 'ext',
        //         'section' => 'overview',
        //     ];
        //     //ajax loading and tabs
        //     return $page;
        // }

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
