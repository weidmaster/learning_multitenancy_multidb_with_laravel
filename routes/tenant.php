<?php

use App\Http\Controllers\Tenant\CompanyController;
use App\Http\Controllers\Tenant\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('company/create', [CompanyController::class, 'create'])->name('company.create');
Route::post('company', [CompanyController::class, 'store'])->name('company.store');
Route::get('company/edit/{domain}', [CompanyController::class, 'edit'])->name('company.edit');
Route::get('company/{domain}', [CompanyController::class, 'show'])->name('company.show');
Route::put('company/{id}', [CompanyController::class, 'update'])->name('company.update');
Route::delete('company/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
Route::get('companies', [CompanyController::class, 'index'])->name('company.index');

Route::get('/', [TenantController::class, 'index'])->name('tenant');
