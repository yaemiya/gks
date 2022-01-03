<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $primarykey = 'menu_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'menu_id',
        'menu_name',
        'price',
        'unit',
        'tax_rate',
        'plant_id',
        'delete_flag',
        'deleted_at'
    ];
}
