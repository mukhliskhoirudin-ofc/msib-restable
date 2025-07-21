<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'name' => ['required', 'min:3', Rule::unique('menus', 'name')->ignore($this->route('menu')->id)],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ];
    }
}
