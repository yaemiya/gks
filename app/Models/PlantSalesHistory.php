<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantSalesHistory extends Model
{
    use HasFactory;
    protected $primarykey = 'psh_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'psh_id',
        'processed_product_id',
        'quantity',
        'processed_product_id',
        'quantity',
        'plant_id',
        'shop_id',
        'supplier_id',
        'quantity',
        'plant_id',
        'delete_flag',
        'deleted_at'
    ];
}
