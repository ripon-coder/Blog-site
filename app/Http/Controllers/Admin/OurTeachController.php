<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ourTeachrModel;
use File;
use Image;
class OurTeachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = ourTeachrModel::orderBy('id','DESC')->paginate(20);
        return view('admin.teacher.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
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
            'name' =>'required|max:255',
            'designation' =>'required|max:255',
            'image' =>'required|image|max:1000',
        ]);
       $teacher = new ourTeachrModel();
       $teacher->name = $request->name;
       $teacher->designation = $request->designation;
       $teacher->fb = $request->facebook;
       $teacher->twitter = $request->twitter;
       $teacher->instragram = $request->instragram;

       if ($request->hasFile('image')) {
           $file = $request->image;
           $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
           $image = Image::make($file);
           $image->resize(null, 627, function ($constraint) {
               $constraint->aspectRatio();
           });
           $image->save(storage_path('/app/public/teachers/'.$thumb));
           
           $teacher->image = $thumb;
       }
       $teacher->save();
       return redirect()->route('admin-teacher.index')->with('success','Teacher Added Successfully!');


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
        $teacher = ourTeachrModel::findOrFail($id);
        return view('admin.teacher.edit',compact('teacher'));
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
            'name' =>'required|max:255',
            'image' =>'nullable|image|max:1000',
            'designation' =>'required|max:1000'
        ]);
        $teacher = ourTeachrModel::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->designation = $request->designation;
        $teacher->fb = $request->facebook;
        $teacher->twitter = $request->twitter;
        $teacher->instragram = $request->instragram;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/teachers/' . $teacher->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/teachers/'.$thumb));
                $teacher->image = $thumb;
            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/teachers/'.$thumb));
                $teacher->image = $thumb;
            }
            
        }
        $teacher->save();
        return redirect()->route('admin-teacher.index')->with('success','Teacher Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = ourTeachrModel::findOrFail($id);
        if(isset($teacher->image)){
            $exitfile = storage_path('/app/public/teachers/' . $teacher->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }
        $teacher->delete();
        return redirect()->route('admin-teacher.index')->with('success','Teacher Deleted Successfully!');
    }
}
