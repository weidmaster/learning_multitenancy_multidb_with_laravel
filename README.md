# Estudando a Arquitetura Multi Tenancy com vários Bancos de Dados usando Laravel
Acompanhamento do estudo da arquitetura multi tenancy com múltiplos bancos de dados, usando Laravel, com o treinamento da EspecializaTi.

## Objetivo
Isolar clientes com banco de dados diferentes, usando a mesma aplicação e código-fonte.

## Arquitetura

- Um banco central que terá os dados dos inquilinos (tenants) cadastrados
  - Inquilinos podem ser empresas, lojas, etc. Depende da regra de negócio
- Planos e formas de pagamento também ficam no banco central
- O cadastro de tenants inclui os dados de acesso ao banco de dados próprio
  - isso permite ter o servidor de banco de dados separado
- O acesso de cada tenant é por domínio
- A conexão com o banco de dados é setada dinamicamente a cada acesso
- Migrações rodam para cada tenant de forma independente do banco de dados central
    - existe um comando personalizado para rodar essas migrations
- O cadastro de novos tenants e gerenciamento só é feito pelo domínio principal

## Fluxo de Desenvolvimento

1. Criar modelo de tenants

    ```php artisan make:model Company -m```

    - definir os dados que serão salvos do tenant
    - adicionar dados referentes à conexão do banco de dados do tenant

    ```php
    $table->string('name');
    $table->string('domain')->unique();
    $table->string('db_database')->unique();
    $table->string('db_hostname');
    $table->string('db_username');
    $table->string('db_password');
    ```

1. Definir nova configuração de banco de dados em config/database.php
    - basicamente duplicar a entrada para o mysql e renomear para tenant
    - isso mantém a conexão padrão mysql para o banco de dados central
    - alterar a chave default DB_CONNECTION para tenant

1. Criar classe app\Tenant\ManagerTenant.php
    - responsável por gerenciar tenants
    - desconecta conexão padrão tenant
    - seta nova conexão dinamicamente para tenant

1. Mudar conexão com o banco de dados dinamicamente pelo domínio através de middleware

    ```php artisan make:middleware Tenant\\TenantMiddleware```

    - registrar middleware como global em app/Http/Kernel.php

    ```php
    protected $middleware = [
        ...
        TenantMiddleware::class,
    ];
    ```

1. Criar pasta database/migrations/tenant
    - migrations específicas de cada tenant
    - copiar as migrations padrão do Laravel
    - ```composer dumpautoload```

1. Criar comando Artisan para migrations de Tenant
    - ```php artisan make:command Tenant\\TenantMigrations```
    - conecta em cada banco de dados de tenant ou apenas um tenant específico
    - roda o comando migrate com force usando a pasta migrations/tenant

1. Criar arquivo routes/tenant.php
    - responsável pelas rotas de gerenciamento de tenant
    - apenas o domínio principal pode acessar

1. Criar arquivo de configuração config/tenant.php
    ```php
        return [
            'main_domain' => 'dominio-principal.com'
        ];
    ```

1. Restringir o acesso das rotas de tenant usando middleware

    ```php artisan make:middleware Tenant\\CheckMainDomain```

    - registrar como middleware de rota em app/Http/Kernel.php

        ```php
        protected $routeMiddleware = [
            ...
            'check.main.domain' => CheckMainDomain::class,
        ];
        ```

1. Registrar as rotas de tenant em app/Providers/RouteServiceProvider.php

    ```php
    Route::prefix('tenants')
        ->middleware('web','check.main.domain')
        ->namespace($this->namespace)
        ->group(base_path('routes/tenant.php'));
    ```
