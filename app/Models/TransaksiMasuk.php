<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMasuk extends Model
{
    use HasFactory;

    protected $table = 'incoming_transactions';
    
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'date',
        'status',
        'supplier',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'quantity' => 'integer',
        'status' => 'string'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 