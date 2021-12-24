<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the VendorRfqsValidation controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\VendorRfqs;

use App\Rules\NoTags;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorRfqsValidation extends FormRequest {

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
                'vendorrfq_category' => [
                    'required',
                ],
                
                'vendorrfq_priority' => [
                    'required',
                ],
                // 'vendorrfq_description' => [
                //     'required',
                // ],
                'vendorrfq_due_date_request' => [
                    'required',
                ],
                // 'vendorrfq_sn' => [
                //     'required',
                // ],
                // 'vendorrfq_uom' => [
                //     'required',
                // ],
                // 'vendorrfq_qty' => [
                //     'required',
                // ],
                'vendorrfq_required_quotation_validity' => [
                    'required',
                ],
             
                
            ];
        }

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
