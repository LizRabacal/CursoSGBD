<?php

namespace App\Libraries\mongo\basic;


class ConnectionMongo
{
    private $client;
    private $database;

    protected $collection;

    function __construct(string $collectionName)
    {
        $uri = getenv('MONGO_URI');
        $database = getenv('DATABASE');

        if (empty($uri) || empty($database)) {
            exit('You need to declare ATLAS_URI and DATABASE in your .env file!');
        }

        try {
            $this->client = new \MongoDB\Client($uri);

            $this->database = $this->client->selectDatabase($database);
            $this->collection = $this->database->$collectionName;

        } catch (\Throwable $ex) {
            exit('Couldn\'t connect to database: ' . $ex->getMessage());
        }

        try {
            $this->database = $this->client->selectDatabase($database);
        } catch (\Throwable $ex) {
            exit('Error while fetching database with name: ' . $database . $ex->getMessage());
        }
    }

    function getDatabase()
    {
        return $this->database;
    }
}
