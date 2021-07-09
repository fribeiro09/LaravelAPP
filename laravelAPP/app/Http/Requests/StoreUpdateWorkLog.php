<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateWorkLog extends FormRequest
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
        $id = $this->segment(3);

        $rules = [
            'employee_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'description' => ['required', 'string', 'min:5', 'max:200'],
        ];

        return $rules;
    }
}
