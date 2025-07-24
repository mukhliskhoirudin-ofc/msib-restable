<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChefRequest extends FormRequest
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
            'name'         => ['required', 'string', 'min:3', 'max:255'],
            'position'     => ['required', 'string', 'min:3', 'max:100'],
            'description'  => ['required', 'string', 'min:3', 'max:500'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'insta_link'   => ['nullable', 'url', 'max:255'],
            'linked_link'  => ['nullable', 'url', 'max:255'],
        ];
    }
}
