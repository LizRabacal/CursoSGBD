<?php

namespace App\Libraries\mongo;
use App\Libraries\mongo\basic\ActionModel;

class CategoryModel extends ActionModel
{
    function __construct()
    {
        parent::__construct(collectionName: 'categories');
    }

 
}
