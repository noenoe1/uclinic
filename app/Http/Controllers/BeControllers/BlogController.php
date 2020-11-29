<?php

namespace App\Http\Controllers\BeControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Image;

class BlogController extends Controller
{
    public function index() 
    {
    
        // Synchronously    
        $blogs = Blog::query()
            ->orderByDesc('id')
            ->paginate(5);
       
        return Inertia::render('Be/Blogs/Index', [ 'blogs' => $blogs ] );
    }

    public function create() 
    {   
        
        return Inertia::render('Be/Blogs/Create');
    }

    public function store(Request $request) 
    {   
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createBlog');
        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        //$upload_url = public_path('uploads/');
        //$upload_img = public_path('uploads/'.$imageName);
        $thumb_url = public_path('storage/uploads/thumbnails/'.$imageName);
        //$image->move($upload_url, $imageName);
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300,300);
        $image_resize->save($thumb_url);
        Blog::create([
            'name' => $validator['name'],
            'description' => $validator['description'],
            'blog_photo_path' => $imageName,
            'added_user_id' => Auth::user()->id
        ]);
        
        return redirect()->route('blogs.list');
        
    }

    public function view(Blog $blog) {
        return Inertia::render('Be/Blogs/Update', [ 'blog' => $blog]);
    }

    public function update( Request $request, $blog_id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateBlog');
        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        //$upload_url = public_path('uploads/');
        //$upload_img = public_path('uploads/'.$imageName);
        $thumb_url = public_path('storage/uploads/thumbnails/'.$imageName);
        //$image->move($upload_url, $imageName);
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300,300);
        $image_resize->save($thumb_url);
        $blog = Blog::find($blog_id);
        $blog->forceFill([
            'name' => $validator['name'],
            'description' => $validator['description'],
            'blog_photo_path' => $imageName,
            'added_user_id' => Auth::user()->id
        ])->save();

        return redirect()->route('blogs.list');
        
    }

    public function delete( Request $request, $blog_id)
    {

        $blog = Blog::find($blog_id);
        $img_name = $blog->blog_photo_path;
        $image_path = public_path().'/storage/uploads/thumbnails/'.$img_name;

        if(file_exists($image_path)){
            unlink($image_path);
        }
        $blog->delete();

        return redirect()->route('blogs.list');
        
    }

    public function destroy($blog_id)
    {
        
        $blog = Blog::find($blog_id);
        $image = $blog->blog_photo_path;
        $image_path = public_path().'/storage/uploads/thumbnails/'.$image;
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $blog->forceFill([
            'blog_photo_path' => null,
        ])->save();

        return back(303)->with('status', 'blog-photo-deleted');
    }

    public function getAll(Request $request) {

        return Blog::query()
        ->orderByDesc('id')
        ->paginate(5);
       
    }

    public function search(Request $request, $keywords) 
    {
        return Blog::query()
        ->where('name', $keywords)
        ->orderByDesc('id')
        ->paginate(5);
    }
}
