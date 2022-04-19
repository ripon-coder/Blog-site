<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\gallaryModel;
use File;
use Image;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = gallaryModel::orderBy('id','desc')->paginate(20);
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'description' =>'nullable|max:1000'
        ]);

        $slider = new gallaryModel();
        $slider->title = $request->title;
        $slider->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->resize(null, 627, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(storage_path('/app/public/sliders/'.$thumb));
            
            $slider->image = $thumb;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('success','Slider Added Successfully!');
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
        $slider = gallaryModel::findOrFail($id);
        return view('admin.slider.edit',compact('slider'));
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
            'description' =>'nullable|max:1000'
        ]);
        $slider = gallaryModel::findOrFail($id);
        $slider->title = $request->title;
        $slider->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/sliders/' . $slider->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/sliders/'.$thumb));
                $slider->image = $thumb;
            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/sliders/'.$thumb));
                $slider->image = $thumb;
            }
            
        }
        $slider->save();
        return redirect()->route('slider.index')->with('success','Slider Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = gallaryModel::findOrFail($id);
        if(isset($slider->image)){
            $exitfile = storage_path('/app/public/sliders/' . $slider->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }
        $slider->delete();
        return redirect()->route('slider.index')->with('success','Slider Deleted Successfully!');
    }
}
