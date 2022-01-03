<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPurchaseHistory extends Model
{
    use HasFactory;
    protected $primarykey = 'sph_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sph_id',
        'sph_tx_type',
        'supplied_product_id',
        'processed_product_id',
        'quantity',
        'shop_id',
        'processed_product_id',
        'quantity',
        'purchase_date',
        'delete_flag',
        'deleted_at'
    ];
}
