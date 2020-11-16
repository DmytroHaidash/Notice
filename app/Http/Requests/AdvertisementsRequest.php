<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementsRequest extends FormRequest
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
            'title' => 'string|require',
            'description' => 'require',
            'phone' => 'required|min:10',
            'country' => 'string|required',
            'email' => 'email|required',
            'end_date' => 'required|date',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];
    }
}
