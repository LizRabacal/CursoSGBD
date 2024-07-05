<?php

namespace App\Libraries\mongo;

use App\Entities\Ticket;
use App\Libraries\mongo\basic\ActionModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

class TicketModel extends ActionModel
{
    function __construct()
    {
        parent::__construct(collectionName: 'tickets');
    }

    private function setAggregation(): array
    {
        $pipline = [];


        $pipline[] = [
            '$lookup' => [
                'from' => 'customers',
                'localField' => 'customer_id',
                'foreignField' => '_id',
                'as' => 'customer_array'
            ]

        ];


        $pipline[] = [
            '$addFields' => [
                'customer' => [
                    '$arrayElemAt' => ['$customer_array', 0]
                ]
            ]
        ];

        $pipline[] = [
            '$unset' => 'customer_array',
        ];



        //AGREGÇAO DE CARROSS
        $pipline[] = [
            '$lookup' => [
                'from' => 'cars',
                'localField' => 'car_id',
                'foreignField' => '_id',
                'as' => 'car_array'
            ]

        ];


        $pipline[] = [
            '$addFields' => [
                'car' => [
                    '$arrayElemAt' => ['$car_array', 0]
                ]
            ]
        ];


        $pipline[] = [
            '$unset' => 'car_array',
        ];



        $pipline[] = [
            '$lookup' => [
                'from' => 'categories',
                'localField' => 'category_id',
                'foreignField' => '_id',
                'as' => 'category_array'
            ]

        ];


        $pipline[] = [
            '$addFields' => [
                'category' => [
                    '$arrayElemAt' => ['$category_array', 0]
                ]
            ]
        ];



        $pipline[] = [
            '$unset' => 'category_array',
        ];


        //AGRUPAR OS DADOS

        $pipline[] = [
            '$group' =>[
                //atributos da collection ticket
                '_id' => '$_id',
                'payment_method' => ['$first' => '$payment_method'],
                'status' => ['$first' => '$status'],
                'spot' => ['$first' => '$spot'],
                'vehicle' => ['$first' => '$vehicle'],
                'plate' => ['$first' => '$plate'],
                'observations' => ['$first' => '$observations'],
                'category_value' => ['$first' => '$category_value'],
                'amount_park' => ['$first' => '$amount_park'],
                'amount_paid' => ['$first' => '$amount_paid'],
                'elapsed_time' => ['$first' => '$elapsed_time'],
                'choice' => ['$first' => '$choice'],
                'created_at' => ['$first' => '$created_at'],
                'updated_at' => ['$first' => '$updated_at'],

                //atributos de outras collections

                'customer' => ['$first' => '$customer'],
                'car' => ['$first' => '$car'],
                'category' => ['$first' => '$category'],
            ]

        ];



        return $pipline;
    }

    public function getAll(array $filter = [], bool $asTicketEntity = false): array
    {
        try {
            $pipline = $this->setAggregation();
            if(! empty($filter)){
                $pipline[] = ['$match' => $filter];

            }

            $documents = $this->collection->aggregate($pipline)->toArray();

            if(empty($documents)){
                return [];
            }

            if(! $asTicketEntity){
                return $documents;
            }

            return $this->transformToTicket($documents);







        } catch (\Throwable $th) {
            log_message("erroo: " . $th, 700);
            exit("Internal Serve Error");
        }

        return [];
    }


    private function transformToTicket(&$docuemnts): array
    {
        $tickets = [];

        foreach($docuemnts as $doc){

            $tickets[] = new Ticket((array) $doc);

        }
        return $tickets;

    }


    public function getOrFail(string $id): Ticket
    {
        $pipline = $this->setAggregation();
        $pipline[] = ['$match' => ['_id' => new ObjectId($id)]];

        $result = $this->collection->aggregate($pipline)->toArray();


        $document = $result[0] ?? null;

        return $document !== null ? new Ticket((array) $document) : throw new PageNotFoundException("Não localizamos o ticket ID: {$id}");

    }
}
