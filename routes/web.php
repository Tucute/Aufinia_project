<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// SubscripbeSUPPLIER_CHECKER 
// Route::post('/stripe/webhook/subscribeSUPPLIER_CHECKER', [StripeController::class, 'subscribeSUPPLIER_CHECKER']);
Route::post('/stripe/webhook/subscribeSUPPLIER_CHECKER', [StripeWebhookController::class,'handleWebhook']);

// Stripe event
Route::get('/get-all-customers', [StripeController::class,'getAllCustomers']);

Route::get('/get-object-customers', [Controller::class,'StripeCustomerInfo']);

Route::get('/webhook', [StripeController::class,'webhook']);

Route::get('/send-email', [EmailController::class,'SendEmail']);

Route::get('/handle-webhook', [StripeWebhookController::class, 'handleWebhook']);

Route::get('/stripe/webhook', [StripeWebhookController::class,'handle']);

Route::get('/get-license-key', [Controller::class,'getLicenseKey']);