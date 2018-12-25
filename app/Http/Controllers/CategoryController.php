<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::paginate(3);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // \Log::info(request()->all());
        $categories = Category::all();
        \Log::info($categories);
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'title' => 'required|min:5',
            'slug' => 'required|unique:categories'
        ]);

        $categories = Category::create($request->only('title','description','slug'));
        $categories->childerns()->attach($request->parent_id);
        return back()->with('message','Category Added Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
        //
    {
        // \Log::info($category);
        $categories = Category::all();
    return view('admin.categories.create',['categories' => $categories,'category' => $category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        // \Log::info('message');   
        $category->title = $request->title;
        $category->description = $request->description;
        $category->slug = $request->slug;


        $category->childerns()->detach();

        $category->childerns()->attach($request->parent_id);

        $saved = $category->save();

        return back()->with('message','Record Updated Successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        if($category->delete())
        {
            return back()->with('message','Category Delete Successfully!!!!');
        }
        else
        {
            return back()->with('message','Some Errors Are Ocour');
        }
    }
}
