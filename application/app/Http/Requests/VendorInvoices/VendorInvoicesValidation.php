<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the VendorinvoiceValidation controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\VendorInvoices;

use App\Rules\NoTags;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorInvoicesValidation extends FormRequest {

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
                // 'vendorinvoice_rfq_ref' => [
                //     'required',
                // ],
                
                // 'vendorinvoice_receiving_date' => [
                //     'required',
                // ],
                // 'vendorinvoice_category' => [
                //     'required',
                // ],
                // 'vendorinvoice_invoice_ref_no' => [
                //     'required',
                // ],
                // 'vendorinvoice_total_value' => [
                //     'required',
                // ],
                // 'vendorinvoice_devlivery_time' => [
                //     'required',
                // ],
                'vendorinvoice_status' => [
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
