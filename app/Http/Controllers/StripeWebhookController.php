<?php

namespace App\Http\Controllers;

use App\Mail\sendEmail;
use App\Models\Email_test;
use App\Models\Licensekey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Laravel\Cashier\Events\WebhookReceived;
use Stripe\Event;
use Illuminate\Support\Str;

class StripeWebhookController extends Controller
{
    public function sendEmail($email){

        $supplierCheckerModel = Licensekey::where('email',$email)->first();

        if ($supplierCheckerModel) {
            // $email = $supplierCheckerModel->email;
            $license_key = $supplierCheckerModel->license_key;
            $invoice_date = $supplierCheckerModel->created_at;

            Mail::mailer('smtp')->to($email)->send(new sendEmail($email, $license_key, $invoice_date));
        }
        else {
            return response()->json(['errer' => 'không lấy được dữ liệu']);
        }
        
    }

    public function handleWebhook(Request $request) {

        $payload = $request->getContent();
        $sigHeader = $request->server('HTTP_STRIPE_SIGNATURE');

        try {
            $event = Event::constructFrom(
                json_decode($payload, true),
                $sigHeader,
                config('services.stripe.webhook_secret')
            );

            if($event->type === 'payment_intent.succeeded') {
                $stripeInvoiceObj = $event->data->object;

                $supplierCheckerModel = new Licensekey();

                    $supplierCheckerModel->customer_id =  $stripeInvoiceObj->customer ?? '';
                    $supplierCheckerModel->name = $stripeInvoiceObj->metadata->customer_name ?? '';
                    $supplierCheckerModel->email = $stripeInvoiceObj->metadata->customer_email ?? '';
                    $supplierCheckerModel->product_id = $stripeInvoiceObj->metadata->order_id?? '';
                    $supplierCheckerModel->license_key = strtoupper(Str::uuid());
                    $supplierCheckerModel->save();

                    $this->sendEmail($supplierCheckerModel->email);

                return response()->json(['status' => 'success']);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
