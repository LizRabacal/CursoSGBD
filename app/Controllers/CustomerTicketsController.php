<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\mongo\CategoryModel;
use App\Libraries\ticket\StoreTicketService;
use App\Validation\SingleTicketValidation;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\CustomerDropdownTrait;

class CustomerTicketsController extends BaseController
{
    use CustomerDropdownTrait;
    
    private const VIEWS_DIRECTORY = 'parking/customers/';

    public function new()
    {
        $categoryId = (string) $this->request->getGet('code');
        $spot = (int) $this->request->getGet('spot');

        if (empty($categoryId) || $spot < 1) {
            return redirect()->back()->with('info', 'Não conseguimos identificar a categoria :(');
        }
        $category = (new CategoryModel)->findOrFail($categoryId);

        $data = [
            'title' => 'Criar ticket mensalista',
            'category' => $category,
            'customersOptions' => $this->customersDropdown(),
            'hidden' => ['spot' => $spot, 
            'category_id' => (string) $category['_id']],
            'hidden_plate' => '',
            'hidden_vehicle' => ''
            

        ];


        return view(self::VIEWS_DIRECTORY . 'new', $data);
    }

}
