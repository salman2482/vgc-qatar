<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the FrontCareers controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\FrontCareers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FrontCareerValidation extends FormRequest {

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
        return [];
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
                'frontcareer_title' => [
                    'required',
                ],
                'frontcareer_experience' => [
                    'required',
                ],'frontcareer_category' => [
                    'required',
                ],
                'frontcareer_salary' => [
                    'required',
                ],
                'frontcareer_status' => [
                    'required',
                ],
                'frontcareer_position' => [
                    'required',
                ]
                
            ];
        }

        /**-------------------------------------------------------
         * common rules for both [create] and [update] requests
         * ------------------------------------------------------*/
        $rules += [
            'frontcareer_title' => [
                'required',
            ],
            'frontcareer_experience' => [
                'required',
            ],'frontcareer_category' => [
                'required',
            ],
            'frontcareer_salary' => [
                'required',
            ],
            'frontcareer_status' => [
                'required',
            ],
            'frontcareer_position' => [
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
