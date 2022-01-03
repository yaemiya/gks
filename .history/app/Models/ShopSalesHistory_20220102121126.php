<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSalesHistory extends Model
{
    use HasFactory;
    protected $primarykey = 'ssh_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sph_id',
        'supplied_product_id',
        'quantity',
        'processed_product_id',
        'quantity',
        'shop_id',
        'sales_date',
        'delete_flag',
        'deleted_at'
    ];
}
