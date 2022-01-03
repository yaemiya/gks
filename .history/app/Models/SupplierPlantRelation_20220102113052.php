<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPlantRelation extends Model
{
    use HasFactory;
    protected $primarykey = 'sp_relation_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sp_relation_id',
        'shop_name',
        'address_id',
        'business_kind',
        'rep_emp_no',
        'delete_flag',
        'deleted_at'
    ];
}
