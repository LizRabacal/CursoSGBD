<?php

declare(strict_types=1);

namespace App\Libraries\ticket;

use App\Entities\Ticket;
use App\Enum\PaymentMethod;
use App\Enum\TicketStatus;
use App\Libraries\mongo\TicketModel;
use CodeIgniter\I18n\Time;
use MongoDB\BSON\ObjectId;



class StoreTicketService
{
    private ?array $validatedData;

    private TicketModel $model;


    public function __construct(){
        $this->validatedData = [];
        $this->model = new TicketModel();
    }
    public function createSingle(array $validatedData): bool
    {
        $this->validatedData = $validatedData;
        $datatoStore = array_merge(
            $this->getCommonData(),
            $this->getSingleData()
        );

    

        return $this->model->create($datatoStore);
    }

    private function getCommonData(): array
    {
        return [
            'category_id' => new ObjectId($this->validatedData['category_id']),
            'spot' => (int) $this->validatedData['spot'],
            'status' => TicketStatus::Open->value,
            'created_at' => Time::now()->format('Y-m-d H:i:s'),
        ];
    }

    private function getSingleData(): array
    {
        return [
            'vehicle' => $this->validatedData['vehicle'],
            'plate' => $this->validatedData['plate'],
            'observations' => $this->validatedData['observations'],
            'choice' => $this->validatedData['choice']



        ];
    }

    public function close(Ticket $ticket, string $paymentMethod) : bool {
        $ticket = (new TicketCalculationService)->calculate($ticket);

        $dataToStore = [
            'payment_method' => PaymentMethod::from($paymentMethod)->value,
            'status' => TicketStatus::Closed->value,
            'category_value' => intval($ticket->category_value),
            'amount_park' => intval($ticket->amount_park),
            'amount_paid' => intval($ticket->amount_paid),
            'elapsed_time' => $ticket->elapsed_time,
            'updated_at' => Time::now()->format('Y-m-d H:i:s'),

        ];
        // echo '<pre>';
        // print_r($dataToStore);
        // exit;

        return $this->model->update(id: $ticket->id(), data: $dataToStore);
    }
}
