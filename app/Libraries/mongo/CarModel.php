<?php

namespace App\Libraries\mongo;

use MongoDB\BSON\ObjectId;
use App\Libraries\mongo\basic\ActionModel;
use PhpParser\Node\Stmt\TryCatch;

class CarModel extends ActionModel
{
    function __construct()
    {
        parent::__construct(collectionName: 'cars');
    }

    public function allByCustomerId(string $customerId) : array
    {

        try{
            $filter = ['customer_id' => new ObjectId($customerId)];
            $cursor = $this->collection->find($filter);
            $documents =  $cursor->toArray();
            return $documents;



        }catch(\Throwable $t){
            log_message("Erro desconhecido ao pegar todos os dados: " . $t->getMessage(), 500);

            exit("Internal Server Error");
        }

    }
}
