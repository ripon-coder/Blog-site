<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\noticeModel;
class noticeControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = noticeModel::orderBy('id','desc')->paginate(20);
        return view('admin.notice.index',compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notice.create');
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
            'description' =>'required'
        ]);

        $notice = new noticeModel();
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->save();
        return redirect()->route('admin-notice.index')->with('success','Notice Added Successfully!');
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

        $notice = noticeModel::findOrFail($id);
        return view('admin.notice.edit',compact('notice'));
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
            'description' =>'required'
        ]);

        $notice = noticeModel::findOrFail($id);
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->save();
        return redirect()->route('admin-notice.index')->with('success','Notice Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = noticeModel::findOrFail($id);
        $notice->delete();
        return redirect()->route('admin-notice.index')->with('success','Notice Deleted Successfully!');
    }
}
