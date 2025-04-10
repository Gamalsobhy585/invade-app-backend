<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
       return true;
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'status' => 'sometimes|in:1,2',
            'due_date' => 'sometimes|date',
            'category_id' => 'sometimes|exists:categories,id',
        
        ];
    }

    public function messages()
    {
        return [
            'title.string' => __('messages.validation.title_string'),
            'title.max' => __('messages.validation.title_max'),
            'description.string' => __('messages.validation.description_string'),
            'status.in' => __('messages.validation.status_in'),
            'due_date.date' => __('messages.validation.due_date_date'),
            'category_id.exists' => __('messages.validation.category_id_exists'),
            'category_id.integer' => __('messages.validation.category_id_integer'),
        ];

    }

    
}