<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessedProduct extends Model
{
    use HasFactory;
    protected $primarykey = 'processed_product_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'processed_product_id',
        'processed_product_name',
        'price',
        'unit',
        'tax_rate',
        'supplier_id',
        'delete_flag',
        'deleted_at'
    ];
}
