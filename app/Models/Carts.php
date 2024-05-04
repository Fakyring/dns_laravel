<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "carts";
    protected $primaryKey = "id_cart";
    protected $fillable = [
        'id_user',
        'id_eq',
        'count'
    ];
}
