<?php

namespace App\Http\Controllers;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\blogModel;
use App\Models\adminCategory;
class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEOMeta::setTitle('Blogs');
        $data = array();
        $data['randoms'] = blogModel::inRandomOrder()->limit(10)->get();
        $data['blogs'] = blogModel::orderBy('id','DESC')->paginate(10);
        $data['categories'] = adminCategory::orderBy('id','ASC')->get();
        return view('blog.index',compact('data'));
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
        if(blogModel::where('slug',$id)->exists()){
            $data = array();
            $data['randoms'] = blogModel::inRandomOrder()->limit(10)->get();
            $data['blogs'] = blogModel::where('slug',$id)->first();
            $data['categories'] = adminCategory::orderBy('id','ASC')->get();

            SEOMeta::setTitle($data['blogs']->title);
            SEOMeta::setDescription(Str::limit(strip_tags($data['blogs']->description), 100));
            OpenGraph::addImage(url('/storage/blogs/'.$data['blogs']->image), ['height' => 550, 'width' => 650]);
            return view('blog.show',compact('data'));
        }else{
            return abort(404);
        }
    }

    public function category($slug){
        if(adminCategory::where('slug',$slug)->exists()){
            $data = array();
            $data['cat'] = adminCategory::where('slug',$slug)->first();
            SEOMeta::setTitle($data['cat']->category);
            $data['randoms'] = blogModel::inRandomOrder()->limit(10)->get();
            $data['blogs'] = blogModel::where('category',$data['cat']->id)->paginate(10);
            $data['categories'] = adminCategory::orderBy('id','ASC')->get();
            return view('category.index',compact('data'));
        }else{
            return abort('404');        }
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
