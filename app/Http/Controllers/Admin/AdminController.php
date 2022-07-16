<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminCategory(){
        return view("admin.categorization.categories");
    }

    public function adminCategories(){
        return view("admin.categorization.categories");
    }

    public function adminOtherCategories(){
        return view("admin.categorization.other-categories");
    }

    public function adminProjectTypes(){
        return view("admin.categorization.project-types");
    }

    public function adminProjectDeliverables(){
        return view("admin.categorization.project-deliverables");
    }
}
