<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function getAll(Request $request, int $limit, int $offset, int $login_user_id) {
        return Service::query()
            ->where('added_user_id', $login_user_id)
            ->orderByDesc('id')
            ->limit($limit)
            ->offset($offset)
            ->get();
        
    }

    public function get_service_by_id(int $id) {
        
        return Service::find($id);
        
    }
}
