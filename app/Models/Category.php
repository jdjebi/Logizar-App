<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $tableName = "categories";

    protected $dates = ['created_at'];

    protected $fillable = [
        'name',
        'slug',
        'type'
    ];  

}
