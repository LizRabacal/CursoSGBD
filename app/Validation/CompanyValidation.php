<?php

namespace App\Validation;

class CompanyValidation
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
            'message' => [
                'label' => 'Mensagem',
                'rules' => 'required|max_length[20000]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'max_length' => 'Você atingiu o máximo de caracteres',
                ],
            ],
            'address' => [
                'label' => 'Endereço',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'max_length' => 'Máximo de caracteres é 128.',
                ],
            ],
            'phone' => [
                'label' => 'Telefone',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'max_length' => 'Máximo de caracteres é 128.',
                ],
            ],
            
        ];
    }
}
