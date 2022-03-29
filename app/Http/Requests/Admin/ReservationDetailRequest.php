<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReservationDetailRequest extends FormRequest
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
            'username' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'tanggal_reservasi' => 'required|date',
            'jam_reservasi' => 'required|max:255', 
            'person' => 'required|integer',
            'massage' => 'required'
        ];
    }
}
