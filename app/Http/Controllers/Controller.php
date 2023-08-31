<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Stripe\Stripe;

use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getAllCustomers()
    {
        $stripeSecretKey = config('services.stripe.secret');

        Stripe::setApiKey($stripeSecretKey);

        try {
            $customers = \Stripe\Customer::all();
            return view('customer_info', ['customers' => $customers]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return view('error', ['error' => $e->getMessage()]);
        }
    }

    public function StripeCustomerInfo() {
        $stripeSecretKey = config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($stripeSecretKey);
        $event_id = 'evt_1NfyCKLIyBdY95dHCbRwlF0z';
        $event = $stripe->events->retrieve($event_id);
        return $event;
        // try {
        //     $event = $stripe->events->retrieve($event_id);
        //     return view('customer_info', ['event' => $event]);
        // } catch (\Stripe\Exception\ApiErrorException $e) {
        //     return view('error', ['error' => $e->getMessage()]);
        // }
    }
    public function webhook(Request $request) {
        // $payload = $request->all();
        // dd($payload);
    }

    public function getLicenseKey()
    {
        $uuid = Str::uuid()->toString();
        $license_key = strtoupper($uuid);

        return view('customer_info', ['licensekey' => $license_key]);          
    }
}
