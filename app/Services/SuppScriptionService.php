<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SUPPSubscription; 
use App\Services\SubscriptionHandler;
use Carbon\Carbon; 
use Exception;
use Laravel\Cashier\Invoice;
use Illuminate\Support\Str;

class SuppScriptionService extends Controller
{
    protected $subscriptionHandler;

    // public function __construct(SubscriptionHandler $subscriptionHandler)
    // {
    //     $this->subscriptionHandler = $subscriptionHandler;
    // }

    public function subscribeSUPPLIER_CHECKER(Invoice $stripeInvoiceObj, bool $testMode)
    {
        $appSetting = config('app.plan_id');
        try {
            $suppliercheckerSubscribeModel = new SUPPSubscription();
            
            if ($stripeInvoiceObj->lines->data !== null) {
                $source = $stripeInvoiceObj->lines->data->filter(function ($invoiceLine) {
                    return $invoiceLine->type !== null && $invoiceLine->type === 'subscription';
                });

                if ($source->count() !== 0 && $source !== null) {
                    $invoiceLineItem = $source->first();

                    if ($invoiceLineItem->plan->id === $appSetting) {
                        $suppliercheckerSubscribeModel->StripeCustomerId = $stripeInvoiceObj->customerId ?? '';
                        $suppliercheckerSubscribeModel->StripeCustomerEmail = $stripeInvoiceObj->customerEmail ?? '';
                        $suppliercheckerSubscribeModel->StripeLatestInvId = $stripeInvoiceObj->id ?? '';
                        $suppliercheckerSubscribeModel->StripeSubsrcInterval = (int)($invoiceLineItem->plan->intervalCount ?? 0);
                        $suppliercheckerSubscribeModel->StripeProductId = $invoiceLineItem->price->productId ?? '';
                        $suppliercheckerSubscribeModel->StripePlanId = $invoiceLineItem->plan->id ?? '';
                        $suppliercheckerSubscribeModel->StripeSubsrcId = $invoiceLineItem->subscription ?? '';

                        $suppliercheckerSubscribeModel->CurrentPeriodEnd = $invoiceLineItem->period->end ?? Carbon::now();
                        $suppliercheckerSubscribeModel->CurrentPeriodStart = $invoiceLineItem->period->start ?? Carbon::now()->addMonths(1);

                        if ($stripeInvoiceObj->billingReason === 'subscription_create') {
                            $suppliercheckerSubscribeModel->Licensekey = strtoupper(Str::uuid());
                            $this->subscriptionHandler->saveSUPPLIERCHECKERSubscription($suppliercheckerSubscribeModel, $testMode);
                            $this->sendEmail($suppliercheckerSubscribeModel, $testMode);
                        } else if ($stripeInvoiceObj->billingReason === 'subscription_cycle') {
                            $suppliercheckerSubscribeModel->Licensekey = '';
                            $this->subscriptionHandler->updateSUPPLIERCHECKERSubscription($suppliercheckerSubscribeModel, $testMode);
                            $this->sendEmail($suppliercheckerSubscribeModel, $testMode);
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}

