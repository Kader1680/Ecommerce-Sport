<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // order_id
     protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'ccp_number',
        'cle_rib'
    ];

    public function order(){
    
        return $this->belongsTo(Order::class);
    }

}
