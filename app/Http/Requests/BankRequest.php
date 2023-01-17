<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
          'no_rekening'   => ['required','numeric'],
          'nama_bank'     => ['required'],
          'nama_pemilik'  => ['required'],
        ];
    }

    public function messages()
    {
      return [
        'no_rekening.required'  => 'Nomor Rekening tidak boleh kosong.',
        'nama_bank.required'    => 'Nama Bank harus dipilih.',
        'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong.'
      ];
    }
}
