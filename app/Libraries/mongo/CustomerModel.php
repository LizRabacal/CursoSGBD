<?php

namespace App\Libraries\mongo;

use App\Libraries\mongo\basic\ActionModel;
use MongoDB\Model\BSONDocument;
use MongoDB\BSON\ObjectId;
use CodeIgniter\Exceptions\PageNotFoundException;

class CustomerModel extends ActionModel
{
    function __construct()
    {
        parent::__construct(collectionName: 'customers');
    }


    private function setAggregation() : array {
        $pipline = [];
        $pipline[] = [
            '$lookup' => [
                'from' => 'cars',
                'localField' => '_id',
                'foreignField' => 'customer_id',
                'as' => 'cars'
            ]

        ];

        return $pipline;
        
        
    }


    public function all(): array
    {

        try {
            $pipline = $this->setAggregation();


            $cursor = $this->collection->aggregate($pipline);
            return $cursor->toArray();
        } catch (\RuntimeException $e) {
            log_message("Erro ao pegar todos os dados: " . $e->getMessage(), 500);
            throw new \Exception("Erro ao acessar os dados no MongoDB");
        } catch (\Throwable $th) {
            log_message("Erro desconhecido ao pegar todos os dados: " . $th->getMessage(), 500);
            throw $th;
        }

    }



    public function findOrFail(string $id): BSONDocument
    {
        $pipline = $this->setAggregation();
        $pipline[] = ['$match' => ['_id'=> new ObjectId($id)]];
        try {
            $document = $this->collection->aggregate($pipline)->toArray();

            return $document[0] ?? throw new PageNotFoundException("Não localizamos o registro com id " . $id);
        } catch (\RuntimeException $e) {
            log_message("Erro ao pegar os dados: " . $e->getMessage(), 500);
        }
    }
}
