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

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        $categories = [];

        $projectCategories = $this->projectCategories()->get();

        error_log(json_encode($projectCategories));

        foreach ($projectCategories as $pcategory) {
            if ($pcategory->type == "system") {
                $category = Category::find($pcategory->category_id);
            } else if ($pcategory->type == "other") {
                $category = OtherCategory::find($pcategory->category_id);
            }
            $categories[] = $category;
        }

        return $categories;
    }

    public function projectCategories()
    {
        return $this->hasMany(ProjectCategory::class)->orderBy('created_at');
    }

    public function makeLinkClickable($link, $class='', $target='_blank')
    {
        if ($target) {
            $target = ' target="' . $target . '"';
        }else {
            $target = '';
        }

        if($class){
            $class="class=\"$class\"";
        }

        $pattern = '/((https?:\/\/)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(\/([-\w\/_\.~]*(\?\S+)?)?)*)/';

        //$linkClickable = preg_replace($pattern, '<a href="$1" '.$target.' '.$class.'>$1</a>', $link);

        $linkClickable = preg_replace($pattern, '<a href="$1" '.$target.' '.$class.'>$1</a>', $link);

        return $linkClickable;
    }

}
