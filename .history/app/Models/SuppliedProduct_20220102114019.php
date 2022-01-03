<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliedProduct extends Model
{
    use HasFactory;
    protected $primarykey = 'supplied_product_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'supplied_product_id',
        'supplied_product_name',
        'price',
        'unit',
        'retax_ratep_emp_no',
        'delete_flag',
        'deleted_at'
    ];
}
