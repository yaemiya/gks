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
        'login_id',
        'emp_no',
        'last_name',
        'first_name',
        'email',
        'password',
        'tel',
        'role'
    ];
}
