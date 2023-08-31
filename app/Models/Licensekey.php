<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licensekey extends Model
{
    use HasFactory;
    protected $table = 'licensekey';

    protected $fillble = [
        'customer_id',
        'name',
        'email',
        'product_id',
        'license_key',
    ];
}
