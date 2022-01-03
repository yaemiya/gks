<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessedProduct extends Model
{
    use HasFactory;
    protected $primarykey = 'processed_product_id';
}
