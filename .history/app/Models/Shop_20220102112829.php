<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $primarykey = 'shop_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'shop_id',
        'shop_name',
        'address_id',
        'business_kind',
        'rep_emp_no',
        'delete_flag',
        'deleted_at'
    ];
}
