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
        'supplier_id',
        'plant_id',
        'delete_flag',
        'deleted_at'
    ];
}
