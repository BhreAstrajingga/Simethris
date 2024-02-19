<?php

namespace App\Http\Requests;

use App\Models\Berkas;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBerkasRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('template_create');
    }

    public function rules()
    {
        return [
            'kind' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            
        ];
    }
}