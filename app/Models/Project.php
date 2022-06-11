<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $dates = ['created_at'];

    protected $fillable = [
        'name',
        'description',
    ];  
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
