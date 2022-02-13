<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $primarykey = 'address_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'address_id',
        'postal_code1',
        'postal_code2',
        'postal_code2',
        'prefecture',
        'address',
        'house_num',
        'building',
        'tel',
        'email',
        'delete_flag',
        'deleted_at'
    ];
}
