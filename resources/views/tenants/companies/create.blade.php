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
                        aria-current="page">Nova</li>
                </ol>
            </nav>
            <h1 class="m-0">Cadastrar Nova Empresa</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">
    <form action="{{ route('company.store') }}" method="post">
        @include('tenants.companies._partials.form')
    </form>
</div>

@endsection
