<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'files' => 'required,file|mimes:csv|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'files.required' => 'Files is required',
            'files.mimes' => 'Only the csv files are allowed',
            'file.max' => 'Max file size is 2MB',
        ];
    }
}
