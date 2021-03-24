<?php

namespace App\Console\Commands\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantMigrations extends Command
{
    private $tenant;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrations {id?} {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for Tenants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ManagerTenant $tenant)
    {
        parent::__construct();

        $this->tenant = $tenant;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Run migrations for a specific tenant
        if ($this->argument('id')) {
            $company = Company::find($this->argument('id'));

            if ($company) {
                $this->execCommand($company);
            }
            return;
        }

        // Run migrations for all tenants
        $companies = Company::all();

        foreach ($companies as $company) {
            $this->execCommand($company);
        }
    }

    public function execCommand(Company $company)
    {
        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';

        $this->tenant->setConnection($company);

        $this->info("Connecting company {$company->name}");

        Artisan::call($command, [
            '--force' => true,
            '--path' => '/database/migrations/tenant'
        ]);

        $this->info("End Connecting Company {$company->name}");
        $this->info("---------------------------------------");
    }
}
