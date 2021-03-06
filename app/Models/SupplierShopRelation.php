<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierShopRelation extends Model
{
    use HasFactory;
    protected $primarykey = 'ss_relation_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ss_relation_id',
        'supplier_id',
        'shop_id',
        'delete_flag',
        'deleted_at'
    ];
}
