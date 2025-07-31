<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => ['required', 'min:3', Rule::unique('events', 'name')->ignore($this->route('event')?->id)],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'min:3'],
            'image' => [$this->isMethod('POST') ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'status' => ['required', Rule::in('active', 'inactive')],
        ];
    }
}
