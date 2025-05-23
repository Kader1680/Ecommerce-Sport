<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
      
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
{
    return $this->hasOne(Payment::class);
}



    
}
