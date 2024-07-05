<?php

namespace App\Validation;

class CategoryValidation
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
            'price_hour' => [
                'label' => 'Preço por Hora',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'is_natural_no_zero' => 'O valor deve ser um número natural maior que zero.',
                ],
            ],
            'price_day' => [
                'label' => 'Preço por Dia',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'is_natural_no_zero' => 'O valor deve ser um número natural maior que zero.',
                ],
            ],
            'price_month' => [
                'label' => 'Preço por Mês',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'is_natural_no_zero' => 'O valor deve ser um número natural maior que zero.',
                ],
            ],
            'spots' => [
                'label' => 'Número de Lugares',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Campo obrigatório!',
                    'is_natural_no_zero' => 'O valor deve ser um número natural maior que zero.',
                ],
            ],
        ];
    }
}
