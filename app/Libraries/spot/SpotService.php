<?php

declare(strict_types=1);

namespace App\Libraries\spot;

use App\Libraries\mongo\CategoryModel;


class SpotService
{
    private const COMMON_BTN_CLASSES = 'btn-style-park btn position-relative fw-bold p-1';
    private const CLASS_BTN_FOR_CREATE_TICKET = 'btn-new-ticket';

    private const CLASS_BTN_FOR_VIEW_TICKET = 'btn-view-ticket';

    private const CLASS_BTN_FOR_OCCUPIED_SPOT = 'small-font-plate btn-dark';
    private const CLASS_BTN_FOR_SPOT_FREE = 'btn-spot-free';

    public function getSpots(): string
    {
        $categories = $this->prepareSpots();
        if (empty($categories)) {
            return '
            <div class="container">
                <div class="alert alert-warning text-center">

                    <strong>Não há categorias disponíveis</strong>

                </div>
            </div>
            ';
        }

        $divCols = '';
        foreach ($categories as $category) {
            $divCols .= $this->generateCategoryHtml($category);
        }

        return $divCols;
    }

    private function generateCategoryHtml(object $category): string
    {
        return "<div class='col-md grid-margin stretch-card'>
        
        <div class='card pt-3'>
            <h4 class='text-center card-title'>{$category->name}</h4>
                <ul class='list-inline text-center pt-2'>
                {$this->generateLiElementsHtml($category)}
                </ul>
            </div>
        </div>";
    }


    private function generateLiElementsHtml(object $category): string
    {
        $liElement = '';
        foreach($category->spots as $spot){
            $liElement.= " <li class='list-inline-item m-1'>
                    {$this->generateButtonParkHtml($category, $spot)}
            
                        </li>
                        ";
        }

        return $liElement;
    }

    private function generateButtonParkHtml(object $category, int|string|object $spot): string
    {
        if(is_object($spot)){
            return $this->generateOccupiedButtonHtml($spot);
        }

        return $this->generateFreeSpotButtonHtml($category, $spot);
    }

    private function generateOccupiedButtonHtml(object $spot): string
    {
        $class = '';
        $class.= self::COMMON_BTN_CLASSES;
        $class.= ' ';
        $class .= self::CLASS_BTN_FOR_OCCUPIED_SPOT;
        $class .= ' ';
        $class .= self::CLASS_BTN_FOR_VIEW_TICKET;

        return form_button([
            'type' => 'button',
             'class' => $class,
             'title' => $spot-> $spot->vehicle,
              'data-code' => (string) $spot->ticket_code,
              'content' => "{$spot->plate} {$spot->type}"
        ]);
    }

    private function
    generateFreeSpotButtonHtml(object $category, int|string|object $spot): string
    {
        $class = '';
        $class .= self::COMMON_BTN_CLASSES;
        $class .= ' ';
        $class .= self::CLASS_BTN_FOR_SPOT_FREE;
        $class .= ' ';
        $class .= self::CLASS_BTN_FOR_CREATE_TICKET;

        return form_button([
            'type' => 'button',
            'class' => $class,
            'title' => 'Vaga livre',
            'data-code' => (string) $category->code,
            'data-spot' => $spot,
            'content' => $spot
        ]);    }


    private function prepareSpots(): array
    {
        //buscar categories no mongodb

        $categories = (new CategoryModel)->all();

        if (empty($categories)) {
            return [];
        }


        /**
         * @todo recuperar os ticket em aberto
         */

        $openTickets = [];


        $categoriesPrepared = [];

        foreach ($categories as $category) {
            $categoriesPrepared[] = $this->prepareCategory($category, $openTickets);
        }



        return $categoriesPrepared;
    }



    private function prepareCategory(object $category, array $openTickets): object
    {

        $spotsCategory = [];

        for ($spot = 1; $spot <= $category->spots; $spot++) {
            $spotsCategory[$spot] = $spot;
            $this->addTicketDataToSpot($spotsCategory, $spot, $category, $openTickets);
        }

        return (object)[
            'code' => (string) $category->_id,
            'name' => $category->name,
            'spots' => $spotsCategory
        ];
    }

    private function addTicketDataToSpot(array &$spotsCategory, int $spot, object $category, array $openTickets): void
    {
        //percorrer tickets em aberto
        foreach ($openTickets as $ticket) {
            //castings id->tipo apropriado
            $categoryId = (string) $category->_id;
            $ticketCategory = (string) $ticket->category->_id;
            $ticketSpot = (int) $ticket->spot;

            //verificar se a categoria e a vaga correspondem a 1 ticket

            if ($categoryId === $ticketCategory && $spot === $ticketSpot) {
                //adiciono informações do ticket a vaga

                $spotsCategory[$spot] = (object) [
                    'plate' => $ticket->plate,
                    'ticket_code' => (string) $ticket->_id,
                    'vehicle' => $ticket->vehicle,
                    'type' => empty($ticket->customer) ? 'Avulso' : 'Mensalista'
                ];
            }
        }
    }
}
