<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    protected $table = 'Donations';
    protected $filelable = [
        'id',
        'reference',
        'amount',
        'amount_paid',
        'payment_status',
    ];
    use HasFactory;
}
