<?php

namespace App\Entities;

use App\Enum\PaymentMethod;
use App\Enum\TicketChoice;
use App\Enum\TicketStatus;
use CodeIgniter\Entity\Entity;

class Ticket extends Entity
{
    protected $dates   = ['created_at', 'updated_at'];

    public function id():string{
        return (string) $this->_id;
    }
    public function status():string{
        return TicketStatus::tryFrom($this->status)->toString();
    }
    public function isClosed():string{
        return $this->status === TicketStatus::Closed->value;
    }

    public function car():string{
        if(empty(!$this->hasCostumer())){
            return "{$this->vehicle}  | {$this->plate}";
        }
        return $this?->car?->vehicle . ' | ' .$this?->car?->plate;
    }

    public function category():string{
       
        return $this?->category?->name ?? '<span class="badge badge-danger">Não localizada</span>';
    }

    public function type():string{
        return $this->type === TicketChoice::Month->value ? 'Mensalista' : 'Avulso';

    }

    public function choice():string{
        return TicketChoice::tryFrom($this->choice)->toString();

    }


    public function paymentMethod(): string
    {
        if(! $this->isClosed()){
            return $this->status();
        }
        return PaymentMethod::tryFrom($this->payment_method)->toString();
    }


    public function hasCostumer():bool{
        return $this->customer !==  null;
    }

    public function observations(): string
    {
        return $this->observations ?? 'sem observações';
    }

}
