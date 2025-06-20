<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $isAuthorized = Auth::guard('admin')->check();
        return $isAuthorized;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'harga' => ['required', 'integer', 'min:0'],
            'hari' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'The service title is required.',
            'judul.max' => 'The service title cannot exceed 255 characters.',
            'deskripsi.required' => 'The description is required.',
            'gambar.image' => 'The file must be an image.',
            'gambar.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'gambar.max' => 'The image may not be greater than 2MB.',
            'harga.required' => 'The price is required.',
            'harga.integer' => 'The price must be a whole number.',
            'harga.min' => 'The price cannot be negative.',
            'hari.required' => 'The processing days information is required.',
            'hari.string' => 'The processing days must be text.',
            'hari.max' => 'The processing days information is too long.',
        ];
    }
}
