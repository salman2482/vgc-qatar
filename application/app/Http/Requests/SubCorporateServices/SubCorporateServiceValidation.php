<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the SubCorporateServices controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\SubCorporateServices;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCorporateServiceValidation extends FormRequest {

    /**
     * we are checking authorised users via the middleware
     * so just retun true here
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * custom error messages for specific valdation checks
     * @optional
     * @return array
     */
    public function messages() {
        return [
            'subcorporateservice.required' => 'Upload Picture Of The Service!',
        ];
    }

    /**
     * Validate the request
     * @return array
     */
    public function rules() {

        //initialize
        $rules = [];

        /**-------------------------------------------------------
         * [create] only rules
         * ------------------------------------------------------*/
        if ($this->getMethod() == 'POST') {
            $rules += [
                'subcorporateservice_title' => [
                    'required',
                ],
                'subcorporateservice_description' => [
                    'required',
                ],
                'subcorporateservice_corporate_service' => [
                    'required',
                ],
                'subcorporateservice' => [
                    'required',
                ]
            ];
        }

        /**-------------------------------------------------------
         * common rules for both [create] and [update] requests
         * ------------------------------------------------------*/
        $rules += [
            'subcorporateservice_title' => [
                'required',
            ],
            'subcorporateservice_description' => [
                'required',
            ],
            'subcorporateservice_corporate_service' => [
                'required',
            ]
            
        ];

        //validate
        return $rules;
    }

    /**
     * Custom error handing - show message to front end
     */
    public function failedValidation(Validator $validator) {

        $errors = $validator->errors();
        $messages = '';
        foreach ($errors->all() as $message) {
            $messages .= "<li>$message</li>";
        }

        abort(409, $messages);
    }
}
