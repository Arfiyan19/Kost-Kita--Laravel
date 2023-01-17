<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoUpdateRequest extends FormRequest
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
            'harga_promo'       => ['required','numeric'],
            'start_date_promo'  => ['required'],
            'end_date_promo'    => ['required'],
        ];
    }

    public function messages()
    {
      return [
        'harga_promo.required'      => 'Harga Promo tidak boleh kosong.',
        'harga_promo.numeric'       => 'Harga Promo hanya mendukung angka.',
        'start_date_promo.required' =>  'Tanggal mulai tidak boleh kosong.',
        'end_date_promo.required'   =>  'Tanggal berakhir tidak boleh kosong.'
      ];
    }
}
