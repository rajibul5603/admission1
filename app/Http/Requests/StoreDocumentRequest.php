<?php

namespace App\Http\Requests;

use App\Models\Document;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('document_create');
    }

    public function rules()
    {
        return [
            'userid' => [
                'string',
                'required',
            ],
            'photo' => [
                'required',
            ],
            'sign' => [
                'required',
            ],
            'brid_copy' => [
                'required',
            ],
            'nid_copy' => [
                'required',
            ],
            'last_result_copy' => [
                'required',
            ],
            'institute_confirmation_letter' => [
                'required',
            ],
            'medical_certificate' => [
                'required',
            ],
        ];
    }
}
