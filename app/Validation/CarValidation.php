<?php

namespace App\Validation;

class CarValidation
{
    public function getRules(): array
    {
        return [
            'plate' => [
                'label' => 'Placa',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'max_length' => 'Máximo de caracteres é 128.',
                ],
            ],
            'vehicle' => [
                'label' => 'Veículo',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'max_length' => 'O cpf tem que ter 14 caracteres.',
                ],
            ],
           
            'customer_id' => [
                'label' => 'Cliente',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Campo obrigatório!'
                ],
            ],
           
            
        ];
    }
}
