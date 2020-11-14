<?php

namespace App\Http\Controllers\BeControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index() 
    {
    
        // Synchronously    
        $departments = Department::query()
            ->orderByDesc('id')
            ->with('service')
            ->paginate(5);
       
        return Inertia::render('Be/Departments/Index', [ 'departments' => $departments ] );
    }

    public function create() 
    {   
        
        return Inertia::render('Be/Departments/Create');
    }

    public function store(Request $request) 
    {   
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createService');
        
        Department::create([
            'name' => $validator['name'],
            'service_id' => $request->serviceid,
            'description' => $validator['description'],
            'added_user_id' => Auth::user()->id
        ]);
        
        return redirect()->route('departments.list');
        
    }

    public function view(Department $department) {
        return Inertia::render('Be/Departments/Update', [ 'department' => $department]);
    }

    public function update( Request $request, $department_id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateService');
     
        $service = Department::find($department_id);
        $service->forceFill([
            'name' => $validator['name'],
            'service_id' => $request->serviceid,
            'description' => $validator['description'],
            'added_user_id' => Auth::user()->id
        ])->save();

        return redirect()->route('departments.list');
        
    }

    public function delete( Request $request, $department_id)
    {

        $department = Department::find($department_id);
        $department->delete();

        return redirect()->route('departments.list');
        
    }

    public function getAll(Request $request) {

        $user_id = Auth::id();
        if($user_id != null && $user_id != "") {
            $status = Cache::get($user_id);
            Cache::put($user_id, !$status);
            Inertia::share('isDarkMode', Cache::get($user_id));  
        }else {
            $sessionId = Session::getId();
            $status = Cache::get($sessionId);
            Cache::put($sessionId, $sessionId);
            if($sessionId != null) {
                Inertia::share('isDarkMode', Cache::get($sessionId));
            }            
        }

        return Session::getId();
       
    }
}
