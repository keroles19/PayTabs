<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){

        $model = Category::all();
        return view('welcome')->with([
            'model'=>$model
        ]);
    }

    public function getSupCategory($id){


        $model = Category::with('supCategories')->where('id',$id)->first();
        if($model){
          return  $this->returnResponse(200,'success',$model);
        }
        else{
          return  $this->returnResponse(404,'error');
        }
    }

    private function returnResponse($status,$message,$data=null){
        return response()->json([
           'status'=>$status,
           'message'=>$message,
           'data'=>$data->supCategories
        ]);
    }
}
