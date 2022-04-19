<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\adminCategory;
use App\Models\blogModel;
use File;
use Image;
class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = blogModel::orderBy('id','desc')->paginate(20);
        return view('admin.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = adminCategory::get();
        return view('admin.blog.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' =>'required|max:255',
            'image' =>'required|image|max:1000',
            'category' =>'required|not_in:0',
            'description' =>'nullable|max:1000'
        ]);

        $blog = new blogModel();
        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->resize(null, 627, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(storage_path('/app/public/blogs/'.$thumb));
            
            $blog->image = $thumb;
        }
        $blog->save();
        return redirect()->route('admin-blog.index')->with('success','Blog Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
       $categorys = adminCategory::get();
       $blog = blogModel::findOrFail($id);
       return view('admin.blog.edit',compact('blog','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' =>'required|max:255',
            'image' =>'nullable|image|max:1000',
            'category' =>'required|not_in:0',
            'description' =>'nullable|max:1000'
        ]);

        $blog = blogModel::findOrFail($id);
        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/blogs/' . $blog->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/blogs/'.$thumb));

            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/blogs/'.$thumb));

            }
            $blog->image = $thumb;
            
        }
        $blog->save();
        return redirect()->route('admin-blog.index')->with('success','Blog Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = blogModel::findOrFail($id);
        if(isset($blog->image)){
            $exitfile = storage_path('/app/public/blogs/' . $blog->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }

        $blog->delete();
        return redirect()->route('admin-blog.index')->with('success','Blog Deleted Successfully!');
    }
}
