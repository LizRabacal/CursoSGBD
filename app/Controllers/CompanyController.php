<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Validation\CompanyValidation;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Faker\Provider\ar_JO\Company;

class CompanyController extends BaseController
{

    private CompanyModel $model;

    public function __construct(){
        $this->model = model(CompanyModel::class);
    }
    public function index():string
    {
        $data = [
            'title' => 'Gerenciar informações da empresa'
        ];

        return view('company/index', $data);
        //
    }


    public function process() : RedirectResponse{
        $rules = (new CompanyValidation())->getRules();
        if(! $this->validate($rules)){
            return redirect()->back()->with('danger', 'Verifique os erros e tente novamente')
                ->with('errors', $this->validator->getErrors())->withInput();
        }

        $company = $this->model->getCompany();
        $company->fill($this->validator->getValidated());

        if($company->hasChanged()){
            $this->model->save($company);
        }


        return redirect()->back()->with('success', 'Sucesso!');



    }
}
