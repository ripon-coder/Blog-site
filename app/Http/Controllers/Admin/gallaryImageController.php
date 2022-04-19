<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\gallaryImage;
use Image;
use File;
class gallaryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $gallarys = gallaryImage::orderBy('id','Desc')->paginate(20);
        return view('admin.gallary.index',compact('gallarys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallary.create');
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
        ]);

        $gallary = new gallaryImage();
        $gallary->title = $request->title;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->resize(null, 627, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(storage_path('/app/public/gallarys/'.$thumb));
            
            $gallary->image = $thumb;
        }
        $gallary->save();
        return redirect()->route('admin-gallary.index')->with('success','Gallary Added Successfully!');
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
        $gallary = gallaryImage::findOrFail($id);
        return view('admin.gallary.edit',compact('gallary'));
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
        ]);
        $gallary = gallaryImage::findOrFail($id);
        $gallary->title = $request->title;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/gallarys/' . $gallary->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/gallarys/'.$thumb));
                $gallary->image = $thumb;
            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/gallarys/'.$thumb));
                $gallary->image = $thumb;
            }
            
        }
        $gallary->save();
        return redirect()->route('admin-gallary.index')->with('success','Gallary Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallary = gallaryImage::findOrFail($id);
        if(isset($gallary->image)){
            $exitfile = storage_path('/app/public/gallarys/' . $gallary->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }
        $gallary->delete();
        return redirect()->route('admin-gallary.index')->with('success','Gallary Deleted Successfully!');
    }
}
