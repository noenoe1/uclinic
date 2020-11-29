<?php

namespace App\Http\Controllers\BeControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    
    public function index() 
    {
    
        // Synchronously    
        $products = Product::query()
            ->where('added_user_id', Auth::user()->id)
            ->orderByDesc('id')
            ->paginate(5)
            ;
        // return $products;
        return Inertia::render('Be/Products/Index', [ 'products' => $products ] );
    }

    public function create() 
    {   
        
        return Inertia::render('Be/Products/Create');
    }
    
    public function store(Request $request) 
    {   
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createProduct');
     
        Product::create([
            'name' => $validator['name'],
            'price' => $validator['price'],
            'description' => $validator['description'],
            'category_id' => "1",
            'added_user_id' => Auth::user()->id
        ]);
        
        return redirect()->route('products.list');
        
    }

    public function view(Product $product) {
        return Inertia::render('Be/Products/View', [ 'product' => $product]);
    }

    public function update( Request $request, $product_id)
    {

        // Later For find out
        // Gate::forUser(Auth::user())->authorize('update', $product_id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateProduct');
     
        $product = Product::find($product_id);
        $product->forceFill([
            'name' => $validator['name'],
            'price' => $validator['price'],
            'description' => $validator['description'],
            'category_id' => "1",
            'added_user_id' => Auth::user()->id
        ])->save();

        return redirect()->route('products.list');
        
    }

    public function delete( Request $request, $product_id)
    {

        // Later For find out
        // Gate::forUser(Auth::user())->authorize('update', $product_id);
     
        $product = Product::find($product_id);
        $product->delete();

        return redirect()->route('products.list');
        
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
