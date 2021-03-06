<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCategory extends Model
{
    use HasFactory;

    protected $table = "other_categories";

    protected $dates = ['created_at'];

    protected $fillable = [
        'name',
        'slug',
        'type'
    ]; 
}
