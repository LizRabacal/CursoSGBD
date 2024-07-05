<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\mongo\CarModel;
use App\Libraries\mongo\CustomerModel;
use App\Validation\CarValidation;
use CodeIgniter\HTTP\RedirectResponse;
use MongoDB\Model\BSONDocument;
use MongoDB\BSON\ObjectId;

class CarsController extends BaseController
{
    private const VIEWS_DIRECTORY = 'cars/';

    private CarModel $carmodel;
    private CustomerModel $customermodel;

    public function __construct()
    {
        $this->carmodel = new CarModel();
        $this->customermodel = new CustomerModel();
    }

    public function all(string $customerId): string
    {

        
        $customer = $this->customermodel->findOrFail($customerId);
        
        $data = [
            'title' => 'Gerenciar carros do mensalista' . $customer['name'],
            'customer' => $customer,
            'cars' => $customer['cars'] ?? []
        ];



        return view(self::VIEWS_DIRECTORY . 'index', $data);
    }






    public function new($customerId): string
    {
        $customer = $this->customermodel->findOrFail($customerId);

        $data = [
            'title' => 'Novo Carro',
            'customer' => $customer,
            'car' => new BSONDocument(),
        ];

        return view(self::VIEWS_DIRECTORY . 'new', $data);
    }




    public function create(): RedirectResponse
    {
        $this->allowedMethod('post');
        $rules = (new CarValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->with('danger', 'Verifique os erros e tente novamente')
                ->with('errors', $this->validator->getErrors())->withInput();
        }

        $data = $this->validator->getValidated();
        $cid =
        $data['customer_id'];
        $data['customer_id'] = new ObjectId($data['customer_id']);


        if (!$this->carmodel->create(data: $data)) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
                ->withInput();
        }



        return redirect()->to('customers/cars/all/' . $cid)->with('success', 'Sucesso!');
    }



    public function edit(string $id): string
    {
        $car =  $this->carmodel->findOrFail($id);
        $customer = $this->customermodel->findOrFail($car['customer_id']);

        $data = [
            'title' => 'Editar Carro',
            'car' => $car,
            'customer' => $customer
        ];

        return view(self::VIEWS_DIRECTORY . 'edit', $data);
    }





    public function update($id): RedirectResponse
    {
        $this->allowedMethod('put');
        $rules = (new CarValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->with('danger', 'Verifique os erros e tente novamente')
            ->with('errors', $this->validator->getErrors())->withInput();
        }

        $data = $this->validator->getValidated();
        $customerId = (string) $data['customer_id'];
        unset($data['customer_id']);

        
        if (!$this->carmodel->update(id: $id, data: $data)) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
            ->withInput();
        }



        return redirect()->to('customers/cars/all/' . $customerId)->with('success', 'Sucesso!');
    }




    public function delete($id): RedirectResponse
    {

        $this->allowedMethod('delete');

        

        if (!$this->carmodel->delete(id: $id)) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
            ->withInput();
        }



        return redirect()->back()->with('success', 'Sucesso!');
    }









}
