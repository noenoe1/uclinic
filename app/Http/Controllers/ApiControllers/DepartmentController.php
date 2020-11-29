<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Service;

class DepartmentController extends Controller
{
    public function getAll(Request $request, int $limit, int $offset, int $login_user_id) {
        
        return Department::query()
            ->where('added_user_id', $login_user_id)
            ->orderByDesc('id')
            ->limit($limit)
            ->offset($offset)
            ->with('service')
            ->get();
    }

    public function get_department_by_id(int $id) {
        
        return Department::with('service')
            ->find($id);
        
    }
}