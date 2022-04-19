<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\blogModel;
use App\Models\noticeModel;
use App\Models\adminCategory;

class noticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEOMeta::setTitle('Notice');
        $data = array();
        $data['randoms'] = blogModel::inRandomOrder()->limit(10)->get();
        $data['notices'] = noticeModel::orderBy('id','DESC')->paginate(30);
        $data['categories'] = adminCategory::orderBy('id','ASC')->get();
        return view('notice.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(noticeModel::where('slug',$id)->exists()){
            $data = array();
            $data['randoms'] = blogModel::inRandomOrder()->limit(10)->get();
            $data['notice'] = noticeModel::where('slug',$id)->first();
            $data['categories'] = adminCategory::orderBy('id','ASC')->get();

            SEOMeta::setTitle($data['notice']->title);
            SEOMeta::setDescription(Str::limit(strip_tags($data['notice']->description), 100));
            return view('notice.show',compact('data'));
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
