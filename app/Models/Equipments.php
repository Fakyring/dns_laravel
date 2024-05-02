<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "equipments";
    protected $primaryKey = "id_eq";
    protected $fillable = [
        'id_eq',
        'name',
        'type',
        'descr',
        'count',
        'price'
    ];
}
