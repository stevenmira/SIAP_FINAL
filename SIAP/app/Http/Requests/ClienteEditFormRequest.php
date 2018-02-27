<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class ClienteEditFormRequest extends Request
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
            'idcartera'=>'required',
            'nombre'=>'required|max:30',
            'apellido'=>'required|max:30',
            'dui'=>'required|min:10|max:10',
            'nit'=>'required|min:17|max:17',
            'edad'=>'required|min:1|max:2',
            'direccionCliente'=>'required|max:255',
            'telefonocel'=>'min:9|max:9',
            'telefonofijo'=>'min:9|max:9',

            'lugarexpedicion'=>'required|max:50',
            'fechaexpedicion'=>'required'
        ];
    }

    public function messages()
    {
        return [

            //Cliente
            'idcartera.required' =>'El campo -- Selecciona la Cartera -- es obligatorio.',

            'nombre.max' =>'El campo  -- Nombres del cliente -- debe contener 30 caracteres como máximo.',
            'nombre.required' =>'El campo -- Nombres del cliente -- es obligatorio.',

            'apellido.max' =>'El campo  -- Apellidos del cliente -- debe contener 30 caracteres como máximo.',
            'apellido.required' =>'El campo -- Apellidos del cliente -- es obligatorio.',

            'dui.min' =>'El campo -- DUI -- debe tener exactamente 9 dígitos, no menos.',
            'dui.max' =>'El campo -- DUI -- debe tener exactamente 9 dígitos, no más.',
            'dui.required' =>'El campo -- DUI -- es obligatorio.',

            'nit.min' =>'El campo -- NIT -- debe tener exactamente 14 dígitos, no menos.',
            'nit.max' =>'El campo -- NIT -- debe tener exactamente 14 dígitos, no más.',
            'nit.required' =>'El campo -- NIT -- es obligatorio.',

            'edad.min' =>'El campo -- Edad -- debe contener 1 caracteres como mínimo.',
            'edad.max' =>'El campo -- Edad -- debe contener 2 caracteres como máximo.',
            'edad.required' =>'El campo -- Edad -- es obligatorio.',

            'direccionCliente.max' =>'El campo -- Dirección del cliente -- debe contener 255 caracteres como máximo.',
            'direccionCliente.required' =>'El campo -- Dirección del cliente -- es obligatorio.',

            'telefonocel.min' =>'El campo -- Teléfono Celular -- debe tener exactamente 8 dígitos, no menos.',
            'telefonocel.max' =>'El campo -- Teléfono Celular -- debe tener exactamente 8 dígitos, no más.', 

            'telefonofijo.min' =>'El campo -- Teléfono fijo -- debe tener exactamente 8 dígitos, no menos.',
            'telefonofijo.max' =>'El campo -- Teléfono fijo -- debe tener exactamente 8 dígitos, no más.', 

            //Negocio
            
            'lugarexpedicion.max' =>'El campo  -- Lugar de Expedición (DUI) -- debe contener 50 caracteres como máximo.',
            'lugarexpedicion.required' =>'El campo -- Lugar de Expedición (DUI) -- es obligatorio.', 

            'fechaexpedicion.required' =>'El campo -- Fecha de Expedición (DUI) -- es obligatorio.'    
            
        ];
    }
}
