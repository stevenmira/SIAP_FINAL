<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class LiquidacionFormRequest extends Request
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
            'total_diario'=>'required|between:0,99999.99',
            'fecha_efectiva'=>'required'
        ];
    }

    public function messages()
    {
        return [

            //pago
            'total_diario.required' =>'El campo -- TOTAL DIARIO -- es obligatorio.',
            'total_diario.between' =>'El campo -- TOTAL DIARIO -- debe estar en el siguiente rango: 0, 99999.99',
            'fecha_efectiva.required' =>'El campo -- FECHA EFECTIVA DE PAGO -- es obligatorio.'

            
        ];
    }
}
