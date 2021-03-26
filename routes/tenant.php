<?php

use App\Http\Controllers\Tenant\CompanyController;
use App\Http\Controllers\Tenant\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('company/store', [CompanyController::class, 'store'])->name('company.store');

Route::get('/', [TenantController::class, 'index'])->name('tenant');
