@extends('tenants.layouts.main')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('tenant') }}"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item"
                        aria-current="page"><a href="{{ route('company.index') }}">Empresas</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">Detalhes</li>
                </ol>
            </nav>
            <h1 class="m-0">Detalhes da Empresa {{ $company->name }}</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">

<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Informações básicas</strong></p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nome</label><br>
                        <input id="name" readonly
                               type="text"
                               class="form-control-flush"
                               value="{{ $company->name }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="domain">Domínio</label><br>
                        <input id="domain" readonly
                               type="text"
                               class="form-control-flush"
                               value="{{ $company->domain }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Banco de Dados</strong></p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="db_database">Banco de Dados</label><br>
                        <input id="db_database" readonly
                               type="text"
                               class="form-control-flush"
                               value="{{ $company->db_database }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="db_hostname">Servidor</label><br>
                        <input id="db_hostname" readonly
                               type="text"
                               class="form-control-flush"
                               value="{{ $company->db_hostname }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="db_username">Usuário</label><br>
                        <input id="db_username" readonly
                               type="text"
                               class="form-control-flush"
                               value="{{ $company->db_username }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="db_password">Senha</label><br>
                        <input id="db_password" readonly
                               type="text"
                               class="form-control-flush"
                               placeholder="Senha:"
                               value="{{ $company->db_password }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-right mb-5">
    <form action="{{ route('company.destroy', $company->id) }}" method="post">
        @csrf

        <input type="hidden" name="_method" value="DELETE">

        <button type="submit" class="btn btn-danger">Deletar Empresa: {{ $company->name }}</button>
    </form>
</div>

</div>

@endsection
