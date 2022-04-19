<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChairmanModel;
use Image;
use File;
class chairmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chairmans = ChairmanModel::orderBy('id','DESC')->paginate(20);
        return view('admin.chairman.index',compact('chairmans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.chairman.create');
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
            'image' =>'required|image|max:1000',
            'description' =>'nullable|max:1000'
        ]);

        $chairman = new ChairmanModel();
        $chairman->name = $request->name;
        $chairman->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->resize(null, 627, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(storage_path('/app/public/chairmans/'.$thumb));
            
            $chairman->image = $thumb;
        }
        $chairman->save();
        return redirect()->route('chairman.index')->with('success','Chairman Added Successfully!');
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
        $chairman = ChairmanModel::findOrFail($id);
        return view('admin.chairman.edit',compact('chairman'));
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
            'description' =>'nullable|max:1000'
        ]);
        $chairman = ChairmanModel::findOrFail($id);
        $chairman->name = $request->name;
        $chairman->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/chairmans/' . $chairman->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/chairmans/'.$thumb));
                $chairman->image = $thumb;
            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/chairmans/'.$thumb));
                $chairman->image = $thumb;
            }
            
        }
        $chairman->save();
        return redirect()->route('chairman.index')->with('success','Chairman Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chairman = ChairmanModel::findOrFail($id);
        if(isset($chairman->image)){
            $exitfile = storage_path('/app/public/chairmans/' . $chairman->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }
        $chairman->delete();
        return redirect()->route('chairman.index')->with('success','Chairman Deleted Successfully!');
    }
}
