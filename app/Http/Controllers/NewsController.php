<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index(){
        $news = News::all();
        return view("news.list",["news" =>$news]);

    }

    public function create(){
        return view("news.create");
    }

    public function store(Request $request){
        $rules=[
            "title"=> "required",
            "author"=>"required|string",
            "description" =>"required",
        ];

        if($request->image !=""){
            $rules["image"]="image";
        }

        $validators = Validator::make($request->all(), $rules);
        if($validators->fails()){
            return redirect()->route("news.create")->withErrors($validators)->withInput();
        }
        else{
            $news = new News();
            $news->title = $request->title;
            $news->author = $request->author;
            $news->description = $request->description;

            $news ->save();

            if($request->image != ""){
                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time().".".$ext;

                $image->move(public_path("uploads/news"), $imageName);
                $news->image = $imageName;
                $news->save();
            }
            
            return redirect()->route("news.index")->with("success","News added successfully!");
    

        }
    }
        

    public function edit($id){

        $news = News::findOrFail($id);
        return view('news.edit',['news' => $news]);
    }

    public function update(Request $request, $id){
        $news = News::findOrFail($id);
        $rules=[
            "title"=> "required",
            "author"=>"required|string",
            "description" =>"required",
        ];

        if($request->image !=""){
            $rules["image"]="image";
        }

        $validators = Validator::make($request->all(), $rules);
        if($validators->fails()){
            return redirect()->route("news.edit",$news->id)->withErrors($validators)->withInput();
        }
        else{
            $news->title = $request->title;
            $news->author = $request->author;
            $news->description = $request->description;

            $news ->save();

            if($request->image != ""){
                File::delete(public_path("uploads/news/".$news->image));
                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time().".".$ext;

                $image->move(public_path("uploads/news"), $imageName);
                $news->image = $imageName;
                $news->save();
            }
            
            return redirect()->route("news.index")->with("success","News added successfully!");
    

        }

    }
    public function destroy($id){
        $news = News::findOrFail($id);
        File::delete(public_path("uploads/news/".$news->image));
        $news->delete();
        return redirect()->route("news.index")->with("success","News deleted successfully!");
    }
}
