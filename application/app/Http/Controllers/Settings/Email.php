<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for email settings
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use App\Http\Responses\Settings\Email\IndexResponse;
use App\Http\Responses\Settings\Email\UpdateResponse;
use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;
use Validator;

class Email extends Controller {

    /**
     * The settings repository instance.
     */
    protected $settingsrepo;

    public function __construct(SettingsRepository $settingsrepo) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        //settings general
        $this->middleware('settingsMiddlewareIndex');

        $this->settingsrepo = $settingsrepo;

    }

    /**
     * Display general settings
     *
     * @return \Illuminate\Http\Response
     */
    public function general() {

        //crumbs, page data & stats
        $page = $this->pageSettings('general');

        $settings = \App\Models\Settings::find(1);

        //reponse payload
        $payload = [
            'page' => $page,
            'section' => 'general',
            'settings' => $settings,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateGeneral() {

        //validate the form
        $validator = Validator::make(request()->all(), [
            'settings_email_from_address' => 'required|email',
            'settings_email_from_name' => 'required',
        ]);

        //validation errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }
            
            abort(409, $messages);
        }

        //update
        if (!$this->settingsrepo->updateEmailGeneral()) {
            abort(409);
        }

        //reponse payload
        $payload = [];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Display general settings
     *
     * @return \Illuminate\Http\Response
     */
    public function smtp() {

        //crumbs, page data & stats
        $page = $this->pageSettings('smtp');

        $settings = \App\Models\Settings::find(1);

        //reponse payload
        $payload = [
            'page' => $page,
            'section' => 'smtp',
            'settings' => $settings,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSMTP() {


        //validate the form
        $validator = Validator::make(request()->all(), [
            'settings_email_smtp_host' => 'required_with:settings_email_smtp_status,on',
            'settings_email_smtp_port' => 'required_with:settings_email_smtp_status,on',
            'settings_email_smtp_username' => 'required_with:settings_email_smtp_status,on',
            'settings_email_smtp_password' => 'required_with:settings_email_smtp_status,on',
        ]);

        //validation errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }
            
            abort(409, $messages);
        }

        //update
        if (!$this->settingsrepo->updateEmailSMTP()) {
            abort(409);
        }

        //reponse payload
        $payload = [];

        //generate a response
        return new UpdateResponse($payload);
    }
    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        $page = [
            'crumbs_special_class' => 'main-pages-crumbs',
            'page' => 'settings',
            'meta_title' =>  __('lang.settings'),
            'heading' =>  __('lang.settings'),
        ];

        //general settings
        if ($section == 'general') {
            $page['crumbs'] = [
                __('lang.settings'),
                __('lang.email'),
                __('lang.general_settings'),
            ];
        }

        //smtp settings
        if ($section == 'smtp') {
            $page['crumbs'] = [
                __('lang.settings'),
                __('lang.email'),
                __('lang.smtp_settings'),
            ];
            $page['submenu_projects_general'] = 'active';
        }

        return $page;
    }

}
