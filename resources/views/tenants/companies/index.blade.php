@extends('tenants.layouts.main')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('tenant') }}"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">Empresas</li>
                </ol>
            </nav>
            <h1 class="m-0">Empresas</h1>
        </div>
        <a href="{{ route('company.create') }}"
            class="btn btn-success ml-3">Nova <i class="material-icons">add</i></a>
    </div>
    <div class="card">
        @include('tenants.includes.alerts')
        <div class="table-responsive"
             data-toggle="lists"
             data-lists-values='["js-lists-values-employee-name"]'>

            <table class="table mb-0 thead-border-top-0 table-striped">
                <thead>
                    <tr>

                        <th style="width: 30px;"
                            class="text-center">#ID</th>
                        <th>Empresa</th>
                        <th style="width: 200px;">Criada em</th>
                        <th style="width: 50px;">

                        </th>
                    </tr>
                </thead>
                <tbody class="list"
                       id="companies">

                    @forelse ($companies as $company)
                    <tr>

                        <td>
                            <div class="badge badge-soft-dark">#{{ $company->id }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">

                                <div class="d-flex align-items-center">
                                    <i class="material-icons icon-16pt mr-1 text-blue">business</i>
                                    <a href="{{ route('company.show', $company->domain) }}">{{ $company->name }}</a>
                                </div>

                                <div class="badge badge-warning ml-2">PRO</div>

                            </div>
                            <div class="d-flex align-items-center">
                                <small class="text-muted"><i class="material-icons icon-16pt mr-1">link</i> {{ $company->domain }}</small>
                            </div>
                        </td>
                        <td style="width: 200px;"><i class="material-icons icon-16pt text-muted-light mr-1">today</i> {{ $company->created_at }}</td>
                        <td><a href="{{ route('company.edit', $company->domain) }}"
                               class="btn btn-sm btn-link"><i class="material-icons icon-16pt">arrow_forward</i></a> </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="9">
                            Nenhuma empresa cadastrada no momento
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="card-body text-right">
            {!! $companies->links() !!}
        </div>

    </div>
</div>

@endsection
