<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\spot\SpotService;
use CodeIgniter\HTTP\ResponseInterface;

class ParkingController extends BaseController
{
    private const VIEWS_DIRECTORY = 'parking/';

    private SpotService $service;

    public function __construct(){
        $this->service = new SpotService();
    }



    public function index()
    {
        $data = [
            'title' => 'Disposição das vagas',
            'spots' => $this->service->getSpots()
          
        ];



        return view(self::VIEWS_DIRECTORY . 'index', $data);
    }
}
