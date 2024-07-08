<?php

namespace App\Controllers;

use App\Libraries\mongo\TicketModel;
use App\Libraries\ticket\PaymentMethodService;
use App\Libraries\ticket\StoreTicketService;
use App\Libraries\ticket\TicketCalculationService;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class CloseTicketController extends BaseController
{
    public function close(string $id)
    {

        $ticket = (new TicketModel())->getOrFail($id);

        //calculR valores
        $ticket = (new TicketCalculationService)->calculate($ticket);


        $data = [
            'title' => 'Detalhes do Ticket',
            'ticket' => $ticket,
            'paymentMethods' =>  (new PaymentMethodService)->options($ticket->amount_due)

        ];

        //Calcular o ticket



        return view('parking/close', $data);
            
    }

    public function process(string $id) : RedirectResponse
    {

        $ticket = (new TicketModel())->getOrFail($id);
        
        $store = new StoreTicketService();

        if(! $store->close($ticket, (string) $this->request->getPost('payment_method'))){
            return redirect()->back()->with('danger', 'Não foi possível processar o encerramento do ticket'); 
              }


        //Calcular o ticket



        return redirect()->to("parking/show/ticket?ticket_id=".$id)->with('success', 'Sucesso!'); 
            
    }
}
