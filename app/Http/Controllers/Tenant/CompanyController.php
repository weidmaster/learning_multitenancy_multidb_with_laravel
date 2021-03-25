<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function store(Request $request)
    {
        //Here would be a real CRUD functionality.
        //This is just for test purposes
        $company = $this->company->create([
            'name' => 'Empresa XPTO' . Str::random(5),
            'domain' => Str::random(5) . 'empresaxpto.com',
            'db_database' => 'multi_tenant' . Str::random(5),
            'db_hostname' => 'mysql',
            'db_username' => 'root',
            'db_password' => 'root'
        ]);

        //In a real application there would be a checkbox to decide
        // if the database would be created or use an external Database
        // and just run the migrations
        if (true) {
            event(new CompanyCreated($company));
        } else {
            event(new DatabaseCreated($company));
        }

        dd($company);
    }
}
