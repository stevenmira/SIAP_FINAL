<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class NegocioFormRequest extends Request
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
            'nombreNegocio'=>'required|max:50',
            'actividadEconomica'=>'required|max:50',
            'direccionNegocio'=>'required|max:255'
        ];
    }

    public function messages()
    {
        return [

            //Negocio

            'nombreNegocio.max' =>'El campo  -- Nombre del negocio -- debe contener 50 caracteres como máximo.',
            'nombreNegocio.required' =>'El campo -- Nombre del negocio -- es obligatorio.',

            'actividadEconomica.max' =>'El campo  -- Actividad Economica -- debe contener 50 caracteres como máximo.',
            'actividadEconomica.required' =>'El campo -- Actividad Economica -- es obligatorio.',

            'direccionNegocio.max' =>'El campo  -- Dirección del negocio -- debe contener 255 caracteres como máximo.',
            'direccionNegocio.required' =>'El campo -- Dirección del negocio -- es obligatorio.'   
            
        ];
    }
}
