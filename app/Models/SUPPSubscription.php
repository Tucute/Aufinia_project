<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SUPPSubscription extends Model
{
    use HasFactory;

    protected $table = 'supp_subscriptions'; // Tên bảng trong CSDL
    protected $primaryKey = 'id'; // Khóa chính của bảng
    protected $fillable = [
        'StripeCustomerId',
        'StripeCustomerEmail',
        'StripeLatestInvId',
        'StripeSubsrcInterval',
        'StripeProductId',
        'StripePlanId',
        'StripeSubsrcId',
        'CurrentPeriodStart',
        'CurrentPeriodEnd',
        'Licensekey'
        // Các cột khác trong bảng
    ];
    protected $casts = [
        'CurrentPeriodStart' => 'datetime',
        'CurrentPeriodEnd' => 'datetime'
    ];
}
