<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use MongoDB\Model\BSONDocument;
use App\Libraries\mongo\CustomerModel;
use App\Validation\CustomerValidation;

class CustomersController extends BaseController
{
    
    private const VIEWS_DIRECTORY = 'customers/';


    private CustomerModel $model;

    public function __construct()
    {
        $this->model = new CustomerModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Gerenciar mensalistas',
            'customers' => $this->model->all()
        ];
        return view(self::VIEWS_DIRECTORY . 'index', $data);
    }

    public function show($id): string
    {
        $data = [
            'title' => 'Detalhes',
            'customer' => $this->model->findOrFail($id)
        ];
        return view(self::VIEWS_DIRECTORY . 'show', $data);
    }



    public function new(): string
    {
        $data = [
            'title' => 'Novo mensalista',
            'customers' => new BSONDocument()
        ];
        return view(self::VIEWS_DIRECTORY . 'new', $data);
    }




    public function create(): RedirectResponse
    {
        $this->allowedMethod('post');
        $rules = (new CustomerValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->with('danger', 'Verifique os erros e tente novamente')
            ->with('errors', $this->validator->getErrors())->withInput();
        }



        if (!$this->model->create(data: $this->validator->getValidated())) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
            ->withInput();
        }



        return redirect()->route('customers')->with('success', 'Sucesso!'); 
    }





    public function edit(string $id): string
    {
        $customers =  $this->model->findOrFail($id);

        $data = [
            'title' => 'Editar Mensalista',
            'customers' => $customers
        ];

        return view('customers/edit', $data);
    }












    public function update($id): RedirectResponse
    {

        $rules = (new CustomerValidation)->getRules();
        $this->allowedMethod('put');

        if (!$this->validate($rules)) {
            return redirect()->back()->with('danger', 'Verifique os erros e tente novamente')
            ->with('errors', $this->validator->getErrors())->withInput();
        }


        if (!$this->model->update(id: $id, data: $this->validator->getValidated())) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
            ->withInput();
        }



        return redirect()->route('customers')->with('success', 'Dados atualizados com sucesso!');
    }





    public function delete($id): RedirectResponse
    {

        $this->allowedMethod('delete');


        if (!$this->model->delete(id: $id)) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
            ->withInput();
        }



        return redirect()->route('customers')->with('success', 'Registro deletado com sucesso!');
    }







}
