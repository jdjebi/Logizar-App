<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectCategory;
use Error;

class Project extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $fillable = [
        'name',
        'description',
    ];  
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        $categories = [];

        $projectCategories = $this->projectCategories()->get();

        foreach($projectCategories as $pcategory){
            if($pcategory->type == "system"){
                $category = Category::find($pcategory->category_id);
            }else if($pcategory->type == "other"){
                $category = OtherCategory::find($pcategory->category_id);
            }
            $categories[] = $category;
        }
        
        return $categories;
    }

    public function projectCategories(){
        return $this->hasMany(ProjectCategory::class)->orderBy('created_at');
    }

}
