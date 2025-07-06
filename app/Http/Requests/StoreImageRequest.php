<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'name' => 'required|min:3|unique:images',
            'description' => 'required|min:3',
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    //opsional pesan costum
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'name.unique' => 'Nama gambar sudah terpakai.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.min' => 'Deskripsi minimal 3 karakter.',
            'file.required' => 'Gambar wajib diupload.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format gambar hanya boleh jpeg, jpg, atau png.',
            'file.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
