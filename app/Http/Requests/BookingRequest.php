<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'type'      => ['required', Rule::in(['table', 'event'])],
            'name'      => ['required', 'min:3', 'max:255'],
            'email'     => ['required', 'email:dns'],
            'phone'     => ['required', 'numeric', 'digits_between:10,15'],
            'date'      => ['required', 'date'],
            'time'      => ['required'],
            'people'    => ['required', 'integer', 'min:1'],
            'amount'    => ['nullable', 'numeric'],
            'file'      => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'message'   => ['nullable', 'min:3', 'max:255'],
        ];
    }
}
