<?php

namespace App\Http\Requests;

use App\Models\ExamVersion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExamVersionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('exam_version_create');
    }

    public function rules()
    {
        return [
            'exam_version_name' => [
                'string',
                'min:1',
                'max:30',
                'nullable',
            ],
        ];
    }
}
