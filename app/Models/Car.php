<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use SoftDeletes;
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'stock',
        'vin',
        'make',
        'model',
        'year',
        'mileage',
        'engine_size',
        'transmission',
        'exterior_color',
        'interior_color',
        'interior_materia',
        'buy_now_price',
        'base_price',
        'thumbail',
        'start_date',
        'end_date'
    ];
    
  
}
?>
