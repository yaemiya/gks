<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantPurchaseHistory extends Model
{
    use HasFactory;
    protected $primarykey = 'pph_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'pph_id',
        'supplied_product_id',
        'quantity',
        'plant_id',
        'supplier_id',
        'supplied_product_id',
        'quantity',
        'plant_id',
        'delete_flag',
        'deleted_at'
    ];
}
