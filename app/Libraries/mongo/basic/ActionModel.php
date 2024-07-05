<?php

namespace App\Libraries\mongo\basic;

use CodeIgniter\Exceptions\PageNotFoundException;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use PHPUnit\Event\Test\MockObjectForTraitCreated;
use MongoDB\Exception\RuntimeException;

abstract class ActionModel extends ConnectionMongo
{
    function __construct(string $collectionName)
    {
        parent::__construct(collectionName: $collectionName);
    }

    public function create(array $data): bool
    {
        try {
            $data = esc($data);
            $result = $this->collection->insertOne($data);
            return $result->getInsertedCount() == 1;
        } catch (\Throwable $th) {
        }
    }
    public function update(string $id, array $data): bool
    {
        try {
            $data = esc($data);
            $result = $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $data]);
            return $result->getModifiedCount() ? true : false;  
        } catch (\Throwable $th) {
            exit("Erro desconhecido ao pegar todos os dados: " . $th->getMessage());            
            throw $th;


        }
    }




    public function all(): array
    {
        try {
            $cursor = $this->collection->find([]);
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
        try {
            $document = $this->collection->findOne(['_id' => new ObjectId($id)]);

            return $document ?? throw new PageNotFoundException("Não localizamos o registro com id ". $id);
        } catch (\RuntimeException $e) {
            log_message("Erro ao pegar os dados: " . $e->getMessage(), 500);
        }
    }

    
    public function delete(string $id): bool
    {
        try {
            $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);

            return $result->getDeletedCount() ===1;
        } catch (\Throwable $th) {
            exit("Internal Server Error");
            log_message("Erro ao deletar dado", 500);
        }
    }
}
