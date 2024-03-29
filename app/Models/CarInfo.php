<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
class CarInfo extends Model implements Viewable
{
      use HasFactory;
      use InteractsWithViews;
      protected $fillable = [
        'id'
      ];
}
