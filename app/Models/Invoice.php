<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount_to_pay',
        'end_time',
        'total_amount',
    ];

    // Define relationship with User model
    public function client()
    {
        return $this->belongsTo(User::class);
    }
}
