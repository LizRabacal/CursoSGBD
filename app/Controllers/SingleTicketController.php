<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\mongo\CategoryModel;
use App\Libraries\ticket\StoreTicketService;
use App\Validation\SingleTicketValidation;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class SingleTicketController extends BaseController
{
    private const VIEWS_DIRECTORY = 'parking/single/';

     
    public function new()
    {
        $categoryId = (string) $this->request->getGet('code');
        $spot = (int) $this->request->getGet('spot');
        
        if(empty($categoryId) || $spot<1){
            return redirect()->back()->with('info', 'Não conseguimos identificar a categoria :(');
        }
        $category = (new CategoryModel)->findOrFail($categoryId);

        $data = [
            'title' => 'Criar ticket avulso',
            'category' => $category,
            'hidden' => ['spot' => $spot, 'category_id' => (string) $category['_id']]

        ];
        

        return view(self::VIEWS_DIRECTORY . 'new', $data);
        
    }

    public function create():RedirectResponse
    {

        $rules = (new SingleTicketValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->with('danger', 'Verifique os erros e tente novamente')
            ->with('errors', $this->validator->getErrors())->withInput();
        }

        $storeService = new StoreTicketService();

        if (!$storeService->createSingle($this->validator->getValidated())) {
            return redirect()->back()->with('danger', 'Não foi possível criar o tícket avulso');
        }


        return redirect()->route('parking')->with('success', 'Sucesso!');
    }
}
