<?php

namespace App\Http\Requests;

class OrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'flex' => 'required|numeric',
            'size_id' => 'required|numeric',
            'booked_for' => 'required|date',
        ];
    }
}
