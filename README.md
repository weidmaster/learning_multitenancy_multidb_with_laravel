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

