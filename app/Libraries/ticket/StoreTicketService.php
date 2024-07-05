<?php

declare(strict_types=1);

namespace App\Libraries\ticket;

use App\Enum\TicketStatus;
use CodeIgniter\I18n\Time;
use MongoDB\BSON\ObjectId;



class StoreTicketService
{
    private ?array $validatedData;
    public function __construct(){
        $this->validatedData = [];
    }
    public function createSingle(array $validatedData): bool
    {
        $this->validatedData = $validatedData;
        return false;
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
            'vehicle' => $this->validatedData['vehicle'],
            'vehicle' => $this->validatedData['vehicle'],




        ];
    }
}
