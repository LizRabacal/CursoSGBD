<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use MongoDB\Model\BSONDocument;

class HomeController extends BaseController
{
    private const VIEWS_DIRECTORY = 'home/';

    public function index(): string
    {
        $data = [
            'title' => 'Gerenciar categorias'
        ];
        return view(self::VIEWS_DIRECTORY . 'index', $data);
    }


}
