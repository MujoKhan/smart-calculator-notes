<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculationController extends Model
{
    use HasFactory;

    protected $table = 'calculation_controllers';
    protected $tkey = 'id';
}
