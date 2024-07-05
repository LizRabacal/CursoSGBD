<?php

namespace App\Validation;

class CustomerValidation
{
    public function getRules(): array
    {
        return [
            'name' => [
                'label' => 'Nome',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'max_length' => 'Máximo de caracteres é 128.',
                ],
            ],
            'cpf' => [
                'label' => 'cpf',
                'rules' => 'required|exact_length[14]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'exact_length' => 'O cpf tem que ter 14 caracteres.',
                ],
            ],
            'email' => [
                'label' => 'email',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'max_length' => 'Máximo de caracteres é 128.',
                ],
            ],
            'tel' => [
                'label' => 'tel',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'max_length' => 'Máximo de caracteres é 128.',
                ],
            ],
            
        ];
    }
}
