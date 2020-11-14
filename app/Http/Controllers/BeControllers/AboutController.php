<?php

namespace App\Http\Controllers\BeControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{

    public function view($about_id='1') {
        $about = About::find($about_id);
        if($about == "") {
            return Inertia::render('Be/Abouts/Create');
        } else {
            return Inertia::render('Be/Abouts/Update', [ 'about' => $about]);
        }
        
    }

    public function update( Request $request, $about_id='1')
    {
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateAbout');
     
        $about = About::find($about_id);
        $about->forceFill([
            'name' => $validator['name'],
            'description' => $validator['description'],
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
        ])->save();

        return redirect()->route('abouts.view');
        
    }
}
