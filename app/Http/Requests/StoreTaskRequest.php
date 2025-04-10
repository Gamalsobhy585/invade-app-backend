<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
         return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:1,2',
            'due_date' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',

        ];
    }
    
    public function messages()
    {
        return [


        'title.required' => __('messages.validation.title_required'),
        'title.string' => __('messages.validation.title_string'),
        'title.max' => __('messages.validation.title_max'),
        'description.string' => __('messages.validation.description_string'),
        'status.required' => __('messages.validation.status_required'),
        'status.in' => __('messages.validation.status_in'),
        'due_date.date' => __('messages.validation.due_date_date'),
        'category_id.exists' => __('messages.validation.category_id_exists'),
        'category_id.integer' => __('messages.validation.category_id_integer'),
        'category_id.required' => __('messages.validation.category_id_required'),
    ];

    }
}