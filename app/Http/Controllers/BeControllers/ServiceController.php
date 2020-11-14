<?php

namespace App\Http\Controllers\BeControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Image;

class ServiceController extends Controller
{
    public function index() 
    {
    
        // Synchronously    
        $services = Service::query()
            ->orderByDesc('id')
            ->paginate(5);
       
        return Inertia::render('Be/Services/Index', [ 'services' => $services ] );
    }

    public function create() 
    {   
        
        return Inertia::render('Be/Services/Create');
    }

    public function store(Request $request) 
    {   
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createService');
        
        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        //$upload_url = public_path('uploads/');
        //$upload_img = public_path('uploads/'.$imageName);
        $thumb_url = public_path('storage/uploads/thumbnails/'.$imageName);
        //$image->move($upload_url, $imageName);
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300,300);
        $image_resize->save($thumb_url);
        Service::create([
            'name' => $validator['name'],
            'description' => $validator['description'],
            'service_photo_path' => $imageName,
            'added_user_id' => Auth::user()->id
        ]);
        
        return redirect()->route('services.list');
        
    }

    public function view(Service $service) {
        return Inertia::render('Be/Services/Update', [ 'service' => $service]);
    }

    public function update( Request $request, $service_id)
    {
        // Later For find out
        // Gate::forUser(Auth::user())->authorize('update', $service_id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateService');
        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        //$upload_url = public_path('uploads/');
        //$upload_img = public_path('uploads/'.$imageName);
        $thumb_url = public_path('storage/uploads/thumbnails/'.$imageName);
        //$image->move($upload_url, $imageName);
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300,300);
        $image_resize->save($thumb_url);
        $service = Service::find($service_id);
        $service->forceFill([
            'name' => $validator['name'],
            'description' => $validator['description'],
            'service_photo_path' => $imageName,
            'added_user_id' => Auth::user()->id
        ])->save();

        return redirect()->route('services.list');
        
    }

    public function delete( Request $request, $service_id)
    {
        
        
        $service = Service::find($service_id);
        $img_name = $service->service_photo_path;
        $image_path = public_path().'/storage/uploads/thumbnails/'.$img_name;

        if(file_exists($image_path)){
            unlink($image_path);
        }
        $service->delete();

        return redirect()->route('services.list');
        
    }

    public function destroy($service_id)
    {
        
        $service = Service::find($service_id);
        $image = $service->service_photo_path;
        $image_path = public_path().'/storage/uploads/thumbnails/'.$image;
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $service->forceFill([
            'service_photo_path' => null,
        ])->save();

        return back(303)->with('status', 'service-photo-deleted');
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

    public function getAllservices()
    {
        return Service::query()
        //->where('added_user_id', Auth::user()->id)
        ->orderByDesc('id')
        ->get();
    }

}
