<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\SuppScriptionService;
use Exception;

class StripeController extends Controller
{
    protected $TEST_MODE = true;
    
    public function subscribeSUPPLIER_CHECKER(Request $request)
    {
        try {
            // if ($this->TEST_MODE) {
            //     $this->mockSubscribeSUPPLIER_CHECKER();
            // } else {
                $requestBody = $request->getContent();
                // $event = EventUtility::parseEvent($requestBody, false);
                $event = json_decode($requestBody, true);
                $type = $event->type;
                if ($type !== 'payment_intent.succeeded') {
                    if ($type !== 'customer.subscription.created') {
                        if ($type === 'invoice.payment_succeeded') {
                            $stripeInvoiceObj = $event->data['object'];
                            Log::info($stripeInvoiceObj->created);
                            $SuppScriptionService = new SuppScriptionService();
                            $SuppScriptionService->subscribeSUPPLIER_CHECKER($stripeInvoiceObj, $this->TEST_MODE);
                        }
                    } else {
                        Log::info($requestBody);
                    }
                } else {
                    Log::info($requestBody);
                }
            // }
            return Response::json(['status' => 200]);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return Response::json(['status' => 500, 'data' => $ex->getMessage()]);
        }
    }
}