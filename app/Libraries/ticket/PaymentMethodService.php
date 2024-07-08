<?php

declare(strict_types=1);

namespace App\Libraries\ticket;

use App\Enum\PaymentMethod;

class PaymentMethodService{

    public function options(int|float $amountDue) : string {
            $options = [];
            $options[''] = '-- Escolha -- ';

            if($amountDue < 1){


                $options[PaymentMethod::Free->value] = PaymentMethod::Free->toString();

                return form_dropdown(data: 'payment_method', 
                options: $options,
                selected: old('payment_method'),
                extra: ['class' => 'form-control', 'required' => true]
                );
            }

            foreach(PaymentMethod::cases() as $case){

                if($case->value !== PaymentMethod::Free->value){
                    $options[$case->value] = $case->toString();

                }

            }


        return form_dropdown(
            data: 'payment_method',
            options: $options,
            selected: old('payment_method'),
            extra: ['class' => 'form-control', 'required' => true]
        );
    }
}