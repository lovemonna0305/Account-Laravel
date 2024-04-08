<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
        $rules = [];
        
        $rules['name']          = 'required|max:255';
        $rules['category_id']   = 'required';
        $rules['unit' ]         = 'required';
        $rules['min_qty' ]      = 'required|numeric';
        $rules['unit_price']    = 'required|numeric';
        if ($this->get('discount_type') == 'amount') {
            $rules['discount' ] = 'required|numeric|lt:unit_price';
        }else {
            $rules['discount' ] = 'required|numeric|lt:100';
        }
        $rules['current_stock'] = 'required|numeric';

        return $rules;
    }

    /**
     * Get the validation messages of rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'Product name is required',
            'category_id.required'      => 'Category is required',
            'unit.required'             => 'Unit field is required',
            'min_qty.required'          => 'Minimum purchase quantity is required',
            'min_qty.numeric'           => 'Minimum purchase must be numeric',
            'unit_price.required'       => 'Unit price is required',
            'unit_price.numeric'        => 'Unit price must be numeric',
            'discount.required'         => 'Discount is required',
            'discount.numeric'          => 'Discount must be numeric',
            'discount.lt:unit_price'    => 'Discount can not be gretaer than unit price',
            'current_stock.required'    => 'Current stock is required',
            'current_stock.numeric'     => 'Current stock must be numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */
    public function failedValidation(Validator $validator)
    {
        // dd($this->expectsJson());
        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'message' => $validator->errors()->all(),
                'result' => false
            ], 422));
        } else {
            throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
        }
    }
}
