<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $table = "types";
    protected $primaryKey = "id_type";
    protected $fillable = [
        'id_type',
        'name'
    ];
}
