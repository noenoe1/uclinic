<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{

    public function get_about_by_id(int $id) {
        
        return About::find($id);
        
    }
}