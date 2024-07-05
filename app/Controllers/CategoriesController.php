<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\mongo\CategoryModel;
use App\Models\CategoriesModel;
use App\Validation\CategoryValidation;
use CodeIgniter\HTTP\RedirectResponse;
use MongoDB\Model\BSONDocument;

class CategoriesController extends BaseController
{
    private const VIEWS_DIRECTORY = 'categories/';
    private CategoryModel $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }




    public function index(): string
    {

        $data = [
            'title' => 'Gerenciar categorias',
            'categories' => $this->model->all()
        ];
        return view(self::VIEWS_DIRECTORY . 'index', $data);
    }




    public function new(): string
    {
        $data = [
            'title' => 'Nova Categoria',
            'category' => new BSONDocument()
        ];
        return view(self::VIEWS_DIRECTORY . 'new', $data);
    }
    
    public function create(): RedirectResponse
    {
        $this->allowedMethod('post');
        $rules = (new CategoryValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->with('danger', 'Verifique os erros e tente novamente')
                ->with('errors', $this->validator->getErrors())->withInput();
        }

        $data = $this->prepareData();

        if (!$this->model->create($data)) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
                ->withInput();
        }



        return redirect()->route('categories')->with('success', 'sucesso!');
    }



    public function update($id): RedirectResponse
    {

        $rules = (new CategoryValidation)->getRules();
        $this->allowedMethod('put');

        if (!$this->validate($rules)) {
            return redirect()->back()->with('danger', 'Verifique os erros e tente novamente')
                ->with('errors', $this->validator->getErrors())->withInput();
        }

        $data = $this->prepareData();

        if (!$this->model->update(id: $id, data: $data)) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
                ->withInput();
        }



        return redirect()->route('categories')->with('success', 'Dados atualizados com sucesso!');
    }
    public function delete($id): RedirectResponse
    {

        $this->allowedMethod('delete');
   

        if (!$this->model->delete(id: $id)) {

            return redirect()->back()->with('danger', 'Ocorreu um erro aqui do nosso lado. Por favor tente mais tarde :(')
                ->withInput();
        }



        return redirect()->route('categories')->with('success', 'Registro deletado com sucesso!'); 
    }






    public function edit(string $id): string
    {
        $category =  $this->model->findOrFail($id);

        $data = [
            'title' => 'Editar Categoria',
            'category' => $category
        ];

        return view('categories/edit', $data);
    }





    public function prepareData(): array
    {
        $data = esc($this->validator->getValidated());

        return  [
            'name' => $data['name'],
            'spots' => intval($data['spots']),
            'price_day' => intval($data['price_day']),
            'price_hour' => intval($data['price_hour']),
            'price_month' => intval($data['price_month'])
        ];
    }
}
