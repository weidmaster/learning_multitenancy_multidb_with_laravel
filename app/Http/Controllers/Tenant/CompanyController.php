<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreUpdateCompanyFormRequest;

class CompanyController extends Controller
{
    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;

        $this->middleware('auth');
    }

    public function index()
    {
        $companies = $this->company->latest()->paginate();

        return view('tenants.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('tenants.companies.create');
    }

    public function store(StoreUpdateCompanyFormRequest $request)
    {
        $company = $this->company->create($request->all());

        if ($request->has('create_database')) {
            event(new CompanyCreated($company));
        } else {
            event(new DatabaseCreated($company));
        }

        return redirect()
            ->route('company.index')
            ->withSuccess('Cadastro realizado com sucesso!');
    }

    public function show($domain)
    {
        $company = $this->company->where('domain', $domain)->first();

        if (!$company) {
            return redirect()->back();
        }

        return view('tenants.companies.show', compact('company'));
    }

    public function edit($domain)
    {
        $company = $this->company->where('domain', $domain)->first();

        if (!$company) {
            return redirect()->back();
        }

        return view('tenants.companies.edit', compact('company'));
    }

    public function update(StoreUpdateCompanyFormRequest $request, $id)
    {
        if (!$company = $this->company->find($id)) {
            return redirect()->back()->withInput();
        }

        $company->update($request->all());

        return redirect()
            ->route('company.index')
            ->withSuccess('Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$company = $this->company->find($id)) {
            return redirect()->back();
        }

        $company->delete();

        return redirect()
            ->route('company.index')
            ->withSuccess('Deletado com sucesso!');
    }
}
