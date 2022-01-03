<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $primarykey = 'supplier_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'supplier_id',
        'supplier_name',
        'rep_name',
        'address_id',
        'business_kind',
        'delete_flag',
        'tel',
        'role'
    ];
}
