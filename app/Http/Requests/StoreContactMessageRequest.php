<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subjek' => ['required', 'string', 'max:150'],
            'pesan' => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',

            'subjek.required' => 'Subjek wajib diisi.',
            'subjek.max' => 'Subjek maksimal 150 karakter.',

            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.max' => 'Pesan maksimal 5000 karakter.',
        ];
    }
}