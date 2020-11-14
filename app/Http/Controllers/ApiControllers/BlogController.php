<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function getAll(Request $request, int $limit, int $offset, int $login_user_id) {
        return Blog::query()
            ->where('added_user_id', $login_user_id)
            ->orderByDesc('id')
            ->limit($limit)
            ->offset($offset)
            ->get();
        
    }

    public function get_blog_by_id(int $id) {
        
        return Blog::find($id);
        
    }
}