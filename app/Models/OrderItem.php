<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Relasi ke Produk (untuk mengambil nama, gambar, dll)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke Order (induknya)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}