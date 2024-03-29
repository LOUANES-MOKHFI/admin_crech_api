<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id');
    }

    public function details(){
        return $this->hasMany(OrderDetail::class);
    }
    
}
