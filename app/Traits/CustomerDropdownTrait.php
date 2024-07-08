<?php

declare(strict_types=1);

namespace App\Traits;
use App\Libraries\mongo\CustomerModel;

trait CustomerDropdownTrait{
    public function customersDropdown(?string $id = null) : string {
            $documents =  (new CustomerModel())->all();
            if(empty($documents)){
                return form_dropdown(
                    data: 'customer_id',
                    options: ['' => 'Não há mensalistas disponíveis'],
                    extra: ['class' => 'form-control', 'required' => true, 'disabled' => true, 'id' => 'customer_id']

                );

            }

            $options = [];
            $options[null] =  '--- Escolha ---';
            foreach($documents as $c){
                $options[(string) $c->_id] = "{$c->name} - CPF: {$c->cpf}";

            }

        return form_dropdown(
            data: 'customer_id',
            options: $options,
            selected: $id,
            extra: ['class' => 'form-control', 'required' => true,  'id' => 'customer_id']

        );
    }
}


