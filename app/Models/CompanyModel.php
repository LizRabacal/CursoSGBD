<?php

namespace App\Models;

use App\Entities\CompanyEntity;
use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $DBGroup = 'company';
    protected $table            = 'information';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = CompanyEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [


        'name',
        'phone',
        'address',
        'message',


    ];

   public function getCompany() : CompanyEntity 
   {
    return $this->first() ?? new CompanyEntity();
   }
}
