<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the VendorPos controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\VendorPos;

use App\Rules\NoTags;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorPosValidation extends FormRequest {

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
                // 'vendorpo_po_ref' => [
                //     'required'
                // ],

                'vendorpo_issuing_date' => [
                    'required'
                ],

                'vendorpo_qtn_ref_no' => [
                    'required'
                ],

                'vendorpo_category' => [
                    'required'
                ],

                'vendorpo_total_value' => [
                    'required'
                ],

                'vendorpo_terms_condition' => [
                    'required'
                ],

                // 'vendorpo_document_copy' => [
                //     'required'
                // ],

                // 'vendorpo_last_renewal_copy' => [
                //     'required'
                // ],
                'vendorpo_payment_method' => [
                    'required'
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
