<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function __construct()
    {
        if(\auth()->check()){
            $this->middleware('auth');
        }
        else {
            return view('backend.auth.login');
        }
    }

    public function index()
    {
        if(!\auth()->user()->ability('admin', 'manage_product_categories,show_product_categories')){
            return redirect('admin/index');
        }
        $categories = Category::withCount('products')
            ->when(request('status') != '', function ($query){
                $query->whereStatus(request('status'));
            })
            ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
            ->paginate(request('limit_by') ?? '10')
            ->withQueryString();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!\auth()->user()->ability('admin', 'create_product_categories')){
            return redirect('admin/index');
        }
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!\auth()->user()->ability('admin', 'create_product_categories')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = Category::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        if($category){
            Cache::forget('global_categories');
            return redirect()->route('admin.categories.index')->with([
                'message' => 'Category created successfully',
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('admin.categories.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if(!\auth()->user()->ability('admin', 'update_product_categories')){
            return redirect('admin/index');
        }
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if(!\auth()->user()->ability('admin', 'update_product_categories')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        if($category){
            Cache::forget('global_categories');
            return redirect()->route('admin.categories.index')->with([
                'message' => 'Category updated successfully',
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('admin.categories.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(!\auth()->user()->ability('admin', 'delete_product_categories')){
            return redirect('admin/index');
        }
        $category->delete();
        Cache::forget('global_categories');

        // soft delete or delete with products ?
        return redirect()->route('admin.categories.index')->with([
            'message' => 'Category deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}
