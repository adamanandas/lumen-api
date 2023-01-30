<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TambahSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_supplier' => 'required',
            'telepon_supplier' => 'required',
            'alamat_supplier' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_supplier.required' => 'Nama supplier wajib diisi',
            'telepon_supplier.required' => 'Telepon supplier wajib diisi',
            'alamat_supplier' => 'Alamat supplier wajib diisi',
        ];
    }
}
