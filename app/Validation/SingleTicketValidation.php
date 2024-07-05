<?php

namespace App\Validation;

class SingleTicketValidation
{
    public function getRules(): array
    {
        return [
            'spot' => [
                'label' => 'vaga',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                ],
            ],
            'category_id' => [
                'label' => 'Categoria',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                ],
            ],
           
            'choice' => [
                'label' => 'Tipo',
                'rules' => 'required|in_list[hour, day]',
                'errors' => [
                    'required' => 'Campo obrigatório!'
                ],
            ],

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
            'observations' => [
                'label' => 'Observações',
                'rules' => 'permit_empty|max_length[1000]',
                'errors' => [
                    'max_length' => 'Máximo de caracteres é 1000.',
                ],
            ],
           
            
        ];
    }
}
