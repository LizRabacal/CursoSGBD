<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\mongo\TicketModel;
use App\Libraries\spot\SpotService;
use App\Libraries\ticket\TicketCalculationService;
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

    public function show()
    {

        $ticketId = (string) $this->request->getGet('ticket_id');
        $ticket = (new TicketModel())->getOrFail($ticketId);
       
       //calculR valores
       $ticket = (new TicketCalculationService)->calculate($ticket);

       
        $data = [
            'title' => 'Ticket',
            'ticket' => $ticket
          
        ];

        //Calcular o ticket



        return view(self::VIEWS_DIRECTORY . 'show', $data);
    
    }


    public function close() 
    {

    }
}
