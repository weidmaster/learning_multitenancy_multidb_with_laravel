@include('tenants.includes.alerts')

@csrf

<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Informações básicas</strong></p>
            <p class="text-muted">Defina aqui a identificação da empresa</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input id="name" name="name"
                               type="text"
                               class="form-control"
                               placeholder="Nome:"
                               value="{{ $company->name ?? old('name') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="domain">Domínio</label>
                        <input id="domain" name="domain"
                               type="text"
                               class="form-control"
                               placeholder="Domínio:"
                               value="{{ $company->domain ?? old('domain') }}">
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
            <p class="text-muted">Informe as configurações do banco de dados desta empresa</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="db_database">Banco de Dados</label>
                        <input id="db_database" name="db_database"
                               type="text"
                               class="form-control"
                               placeholder="Database:"
                               value="{{ $company->db_database ?? old('db_database') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="db_hostname">Servidor</label>
                        <input id="db_hostname" name="db_hostname"
                               type="text"
                               class="form-control"
                               placeholder="Host:"
                               value="{{ $company->db_hostname ?? old('db_hostname') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="db_username">Usuário</label>
                        <input id="db_username" name="db_username"
                               type="text"
                               class="form-control"
                               placeholder="Usuário:"
                               value="{{ $company->db_username ?? old('db_username') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="db_password">Senha</label>
                        <input id="db_password" name="db_password"
                               type="text"
                               class="form-control"
                               placeholder="Senha:"
                               value="{{ $company->db_password ?? old('db_password') }}">
                    </div>
                </div>
            </div>

            @if (!isset($company))
            <div class="form-group">
                <label for="create_database">Criar o banco de dados?</label><br>
                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                    <input checked
                           type="checkbox"
                           id="create_database"
                           name="create_database"
                           class="custom-control-input">
                    <label class="custom-control-label"
                           for="create_database">Sim</label>
                </div>
                <label for="create_database"
                       class="mb-0">Sim</label>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="text-right mb-5">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>
