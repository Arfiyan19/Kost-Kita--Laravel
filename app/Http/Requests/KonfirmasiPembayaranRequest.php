<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KonfirmasiPembayaranRequest extends FormRequest
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
          'nama_bank'     => 'required',
          'nama_pemilik'  => 'required',
          'bank_tujuan'   => 'required',
          'tgl_transfer'  => 'required',
          'bukti_bayar'   => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
      return [
        'nama_bank.required'    => 'Nama Bank tidak boleh kosong.',
        'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong.',
        'bank_tujuan.required'  => 'Bank Tujuan harus dipilih.',
        'tgl_transfer.required' => 'Tanggal Transfer tidak boleh kosong.',
        'bukti_bayar.required'  => 'File tidak boleh kosong.',
        'bukti_bayar.image'     => 'File harus gambar.',
        'bukti_bayar.mimes'     => 'File hanya mendukung .jpeg, .png, .jpg,',
        'bukti_bayar.max'       => 'Ukuran File tidak boleh lebih dari 2MB',
        'book.required'         => 'Status Booking harus dipilih.',
      ];
    }
}
