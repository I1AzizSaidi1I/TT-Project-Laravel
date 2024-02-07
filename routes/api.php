<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/me', 'me');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/clients', 'showClients');
    Route::post('/clients', 'handleCreateClient');
    Route::put('/clients/{user_id}', 'handleUpdateClient');
    Route::delete('/client/{user_id}', 'handleDeleteClient');
    Route::get('/clients/calls/{clientId}', 'showCalls');
    Route::post('/clients/call/save', 'handleSaveCall');
});




Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employe','showEmployees');
    Route::post('/employe','handleCreateEmployee');
    Route::put('/employe/{id}','handleUpdateEmployee');
    Route::delete('/employe/{id}','handleDeleteEmployee');
});



Route::controller(InvoiceController::class)->group(function () {
    Route::get('/clients/{clientId}/invoices','getClientInvoices');
    Route::post('/invoices', 'create');
    Route::get('/invoices/{id}', 'show');
    Route::put('/invoices/{id}', 'update');
    Route::delete('/invoices/{id}', 'delete');
});

