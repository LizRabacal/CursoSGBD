<?php

declare(strict_types=1);

namespace App\Libraries\ticket;

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
}
