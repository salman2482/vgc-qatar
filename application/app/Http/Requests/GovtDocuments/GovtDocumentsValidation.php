<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the GovtDocuments controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\GovtDocuments;

use App\Rules\NoTags;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GovtDocumentsValidation extends FormRequest {

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
                'govtdocument_type_of_document' => [
                    'required'
                ],

                'govtdocument_doc_no' => [
                    'required'
                ],

                'govtdocument_renewal_cost' => [
                    'required'
                ],

                'govtdocument_issue_date' => [
                    'required'
                ],

                'govtdocument_validity_date' => [
                    'required'
                ],

                'govtdocument_last_renewal_by' => [
                    'required'
                ],

                // 'govtdocument_document_copy' => [
                //     'required'
                // ],

                // 'govtdocument_last_renewal_copy' => [
                //     'required'
                // ],
                'govtdocument_status' => [
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
