<?php

namespace App\Http\Controllers;

use App\Models\Rfm;
use App\Models\User;
use App\Models\Lineitem;
use App\Models\Material;
use App\Models\Attachment;
use App\Models\RfmMaterial;
use Illuminate\Http\Request;
use App\Repositories\RfmRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Responses\Rfms\SendToAdmin;
use App\Repositories\LineitemRepository;
use App\Http\Requests\Rfms\RfmValidation;
use App\Http\Responses\Rfms\ChangeStatus;
use App\Http\Responses\Rfms\EditResponse;
use App\Http\Responses\Rfms\ShowResponse;
use App\Http\Responses\Rfms\IndexResponse;
use App\Http\Responses\Rfms\StoreResponse;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Rfms\CreateResponse;
use App\Http\Responses\Rfms\RfmPDFResponse;
use App\Http\Responses\Rfms\UpdateResponse;
use App\Http\Responses\Rfms\DestroyResponse;
use App\Http\Responses\Rfms\AssignHocResponse;
use App\Http\Responses\Rfms\SendAdminResponse;
use App\Http\Controllers\Material as ControllersMaterial;

class Rfms extends Controller
{
    protected $rfmrepo;
    protected $lineitemrepo;
    protected $attachmentrepo;

    public function __construct(RfmRepository $rfmrepo,LineitemRepository $lineitemrepo,AttachmentRepository $attachmentrepo) {
        //parent
        parent::__construct();

        $this->rfmrepo = $rfmrepo;
        $this->lineitemrepo = $lineitemrepo;
        $this->attachmentrepo = $attachmentrepo;
          //authenticated
          $this->middleware('auth');
          //Permissions on methods
        $this->middleware('rfmsMiddlewareIndex');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rfms = $this->rfmrepo->search();
         //reponse payload
         $payload = [
            'page' => $this->pageSettings('rfms'),
            'rfms' => $rfms,
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
        $rfm = '';
        $materials = Material::all();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'rfm' => $rfm,
            'materials' => $materials,
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
    public function store(RfmValidation $request)
    {
         //create the project
         if (!$rfm_id = $this->rfmrepo->create()) {
            return abort(409);
        }

        $rfms = $this->rfmrepo->search($rfm_id);
        if (request()->filled('rfm_attachments')) {
            foreach (request('rfm_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'rfms',
                    'attachmentresource_id' => $rfm_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_rfm_image'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('rfm_attachments_video')) {
            foreach (request('rfm_attachments_video') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'rfms',
                    'attachmentresource_id' => $rfm_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_rfm_video'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
         //counting all rows
        $rows = $this->rfmrepo->search();
        $count = $rows->count();

        //reponse payload
        $payload = [
            'count' => $count,
            'rfms' => $rfms,
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
         //get the rfms
         $rfms = $this->rfmrepo->search($id);
         $rfm = $rfms->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $rfm->id)
        ->Where('attachmentresource_type', 'rfms')
        ->get();
        $materials = RfmMaterial::with('rfm','material')->where('rfm_id',$id)->get();
         //reponse payload
         $payload = [
             'rfm' => $rfm,
             'attachments' => $attachments,
             'materials' => $materials,
         ];
         if (request()->segment(3) == 'pdf') {
            //render view
            $rfm = Rfm::where('ref_no',$id);
            return new RfmPDFResponse($payload);
        }
 
         //show the form
         return new ShowResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rfms = $this->rfmrepo->search($id);
        $rfm = $rfms->first();
        $materials = Material::all();

         //get attachment
         $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
         ->Where('attachmentresource_type', 'rfms')
         ->get();

         //reponse payload
         $payload = [
            'page' => $this->pageSettings('edit'),
            'rfm' => $rfm,
            'materials' => $materials,
            'attachments' => $attachments,
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
    public function update(RfmValidation $request, $id)
    {   
         //get rfm
         $rfms = $this->rfmrepo->search($id);
         
         $rfm = $rfms->first();
         //update
         if (!$this->rfmrepo->update($id)) {
             abort(409);
         }
 
         //get rfm
         $rfms = $this->rfmrepo->search($id);
         $rfm = $rfms->first();
         if (request()->filled('rfm_attachments')) {
            foreach (request('rfm_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'rfms',
                    'attachmentresource_id' => $rfm->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_rfm_image'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

         if (request()->filled('rfm_attachments_video')) {
            foreach (request('rfm_attachments_video') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'rfms',
                    'attachmentresource_id' => $rfm->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_rfm_video'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
           //reponse payload
         $payload = [
             'rfms' => $rfms,
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
      if (!\App\Models\Rfm::find($id)) {
        abort(409, __('lang.error_request_could_not_be_completed'));
    }

    //get it in useful format
    $rfms = $this->rfmrepo->search($id);
    $rfm = $rfms->first();
    
    //delete the category
    $rfm->delete();

    //reponse payload
    $payload = [
        'id' => $id,
    ];

        //generate a response
        return new DestroyResponse($payload);
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
                __('lang.rfms'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'rfms',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_rfms' => 'active',
            'sidepanel_id' => 'sidepanel-filter-rfms',
            'dynamic_search_url' => url('rfms/search?action=search&rfmresource_id=' . request('rfmresource_id') . '&rfmresource_type=' . request('rfmresource_type')),
            'add_button_classes' => 'add-edit-rfms-button',
            'load_more_button_route' => 'rfms',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_rfm'),
            'add_modal_create_url' => url('rfms/create?rfmresource_id=' . request('rfmresource_id') . '&rfmresource_type=' . request('rfmresource_type')),
            'add_modal_action_url' => url('rfms?rfmresource_id=' . request('rfmresource_id') . '&rfmresource_type=' . request('rfmresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'rfms') {
            $page += [
                'meta_title' => __('lang.rfms'),
                'heading' => __('lang.rfms'),
                'sidepanel_id' => 'sidepanel-filter-rfms',
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


  public function assignHoa($id)
  {
    $rfms = $this->rfmrepo->search($id);
    $rfm = $rfms->first();
    $users = User::where('type','team')->get();
     //reponse payload
     $payload = [
        'page' => $this->pageSettings('edit'),
        'rfm' => $rfm,
        'users' => $users,
    ];
    return new AssignHocResponse($payload);
  }

//   public function sendToAdmin($id)
//   {
//     $rfms = $this->rfmrepo->search($id);
//     $rfm = $rfms->first();
//     $users = User::where('type','team')->get();
//      //reponse payload
//      $payload = [
//         'page' => $this->pageSettings('edit'),
//         'rfm' => $rfm,
//         'users' => $users,
//     ];

//     return new SendToAdmin($payload);
//     }

  public function changeStatus($id)
  {
    $rfms = $this->rfmrepo->search($id);
    $rfm = $rfms->first();
    $users = User::where('type','team')->get();
     //reponse payload
    $payload = [
        'page' => $this->pageSettings('edit'),
        'rfm' => $rfm,
        'users' => $users,
    ];
    return new ChangeStatus($payload);
    }

   public function  showRfm($id)
   {
        $rfms = $this->rfmrepo->search($id);
        $rfm = $rfms->first();
        $materials = Material::all();
        $rfm_materials = RfmMaterial::where('rfm_id',$id)->get();
        //reponse payload
        $payload = [
            'rfm' => $rfm,
            'materials' => $materials,
            'rfm_materials' => $rfm_materials,
        ];
        
        //process reponse
        return view('pages.rfm_bill.wrapper',compact('payload'));
   }

   public function storeMaterial(Request $request)
   {

        $id = $request->rfm_id;
        //    $material = Material::find($id);
        $rfm = Rfm::find($id);

        $materials = RfmMaterial::where('rfm_id',$id)->pluck('id');
        RfmMaterial::destroy($materials);

        $count = 0;
       if (is_array(request('material_id'))) {
        foreach (request('material_id') as $material_id) {
            //get the material
            if ($material = \App\Models\Material::Where('id', $material_id)->first()) {
                $total = $request->qty[$count] * $material->amount;
                try {
                    RfmMaterial::create([
                            'rfm_id' => $rfm->id,
                            'material_id' => $material_id,
                            'title' => $material->title,
                            'qty' => $request->qty[$count],
                            'total' => $total,
                    ]);
                } catch (\Throwable $th) {
                    echo $th->getMessage();
                }
                $count++;
            }
        }
         //notice
        //  $notification = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));
        return redirect()->to('rfms')->with('success',__('lang.request_has_been_completed'));
    }
       
   }

   public function deleteAttachment($id)
    {
          //check if file exists in the database
          $attachment = \App\Models\Attachment::Where('attachment_uniqiueid', request()->route('uniqueid'))->first();

          //confirm thumb exists
          if ($attachment->attachment_directory != '') {
              if (Storage::exists("files/$attachment->attachment_directory")) {
                  Storage::deleteDirectory("files/$attachment->attachment_directory");
              }
          }
  
          $attachment->delete();
  
          //hide and remove row
          $jsondata['dom_visibility'][] = array(
              'selector' => '#rfm_attachment_' . $attachment->attachment_id,
              'action' => 'slideup-slow-remove',
          );
  
          //response
          return response()->json($jsondata);
    }

    public function downloadAttachment($id)
    {
        //check if file exists in the database
        $attachment = \App\Models\Attachment::Where('attachment_uniqiueid', request()->route('uniqueid'))->first();

        //confirm thumb exists
        if ($attachment->attachment_filename != '') {
            $file_path = "files/$attachment->attachment_directory/$attachment->attachment_filename";
            if (Storage::exists($file_path)) {
                return Storage::download($file_path);
            }
        }
        abort(404);
    }

    /**
     * Show the form for changing a projects status
     * @return \Illuminate\Http\Response
     */
    public function sendAdmin() {

        //get the rfm
        $rfm = \App\Models\Rfm::Where('id', request()->route('rfm'))->first();

        //reponse payload
        $payload = [
            'rfm' => $rfm,
        ];

        //show the form
        return new SendAdminResponse($payload);
    }

    public function sendAdminUpdate()
    {
        
        //validate the rfm exists
        $rfm = \App\Models\Rfm::Where('id', request()->route('rfm'))->first();

        //update the rfm
        $rfm->assign_admin = 'assigned';
        $rfm->save();

        //get refreshed rfm
        $rfms = $this->rfmrepo->search(request()->route('rfm'));
        $rfm = $rfms->first();

      
        //reponse payload
        $payload = [
            'rfms' => $rfms,
            'id' => request()->route('rfm'),
        ];

        //show the form
        return new UpdateResponse($payload);
    }
}
