<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuPackageRequest extends FormRequest
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
            'title' => 'required|max:255',
            'price' => 'required|integer',
            'nasi' => 'required|max:255',
            'sayur' => 'required|max:255',
            'ikan' => 'required|max:255',
            'lauk' => 'required|max:255',
            'pelengkap' => 'required|max:255',
            'gorengan' => 'required|max:255',
            'sambal' => 'required|max:255',
            'desert' => 'required|max:255',
            'minum' => 'required|max:255'
        ];
    }
}
