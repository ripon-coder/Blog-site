<?php

namespace App\Http\Controllers;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Http\Request;
use App\Models\gallaryModel;
use App\Models\ChairmanModel;
use App\Models\ourTeachrModel;
use App\Models\gallaryImage;
use App\Models\blogModel;
use App\Models\noticeModel;
class HomeController extends Controller
{
    public function index(){
        $data = array();
        $data['sliders'] = gallaryModel::orderBy('id','DESC')->get();
        $data['chairmans'] = ChairmanModel::orderBy('id','DESC')->limit(1)->get();
        $data['teachers'] = ourTeachrModel::orderBy('id','DESC')->get();
        $data['gallarys'] = gallaryImage::orderBy('id','DESC')->get();
        $data['blogs'] = blogModel::orderBy('id','DESC')->limit(3)->get();
        $data['notices'] = noticeModel::orderBy('id','DESC')->limit(10)->get();
        return view('home',compact('data'));
    }
}
