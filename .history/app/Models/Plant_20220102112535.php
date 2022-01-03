<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    protected $primarykey = 'plant_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'plant_id',
        'plant_name',
        'address_id',
        'business_kind',
        'rep_emp_no',
        'delete_flag',
        'deleted_at'
    ];
}
