<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the CareersApply controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\CareersApply;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareerApplyValidation extends FormRequest {

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
                // 'careerapply_title' => [
                //     'required',
                // ],
                // 'careerapply_experience' => [
                //     'required',
                // ],'careerapply_category' => [
                //     'required',
                // ],
                // 'careerapply_salary' => [
                //     'required',
                // ],
                // 'careerapply_status' => [
                //     'required',
                // ]
                
            ];
        }

        /**-------------------------------------------------------
         * common rules for both [create] and [update] requests
         * ------------------------------------------------------*/
        $rules += [
            // 'careerapply_title' => [
            //     'required',
            // ],
            // 'careerapply_experience' => [
            //     'required',
            // ],'careerapply_category' => [
            //     'required',
            // ],
            // 'careerapply_salary' => [
            //     'required',
            // ],
            // 'careerapply_status' => [
            //     'required',
            // ]
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
