<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contracts',[ContractController::class,'index'])->name('contract.index');

//Route::post('/contracts', [ContractController::class, 'store'])->name('contract.store');
//Route::get('/contracts/download/{filePath}', [ContractController::class, 'download']);



//Route::get('contracts/create', [ContractController::class, 'create'])->name('contracts.index');
Route::post('contracts', [ContractController::class, 'store'])->name('contract.store');
Route::get('generate-pdf', [ContractController::class, 'generatePdf'])->name('generatePdf');
Route::get('/contract/{id}', [ContractController::class, 'show'])->name('contract.show');
Route::get('contracts/{contract}/download', [ContractController::class, 'download'])->name('contracts.download');
