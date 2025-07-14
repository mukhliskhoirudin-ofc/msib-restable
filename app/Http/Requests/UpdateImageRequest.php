<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|unique:images,name,' . $this->route('image')->id,
            'description' => 'required|min:3',
            'file' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'name.unique' => 'Nama gambar sudah terpakai.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.min' => 'Deskripsi minimal 3 karakter.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format gambar hanya boleh jpeg, jpg, atau png.',
            'file.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
