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
        'postal_code2',
        'postal_code2',
        'address',
        'house_num',
        'building',
        'tel',
        'email',
        'delete_flag',
        'deleted_at'
    ];
}
