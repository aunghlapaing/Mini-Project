<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function master(){
        return view('Layouts/master');
    }

    public function list (){
        $blogs = Blog::select('id','name', 'description', 'image', 'owner_name')
                ->orderBy('created_at', 'desc')
                ->paginate(2);

        return view('main/list',compact('blogs'));
    }

    public function delete($id){
        // dd($id);
        $imageName = Blog::where('id', $id)->value('image'); //find is bug && Query builder

        // dd($imageName);
        unlink(public_path('image/'.$imageName)); //delete locally

        $deleteData = Blog::where ('id', $id)->delete(); //delete on database

        //sweet alert message
        alert()->success('Success','Delete successful');

        return back();

    }

    public function form(Request $request){
        // dd($request->toArray());?

        // $this->validation($request); //use the valitation function

        // return 'success';

        $name = $request->name;
        $description = $request->description;
        $image = $request->file('image');
        $ownerName = $request->ownerName;

        // dd($name, $description, $image, $ownerName);

        if (($name && $description && $image) == null){
            $this->validation($request);
        }else{

            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/image/',$imageName);
                        
            $data = [
                'name'=>$request->name,
                'description'=>$request->description,
                'image'=>$imageName,
                'owner_name'=>$request->ownerName,
            ];
            
            // dd($data);
            
             //insert into table using query builder
            Blog::create($data);

            //sweet alert message
            alert()->success('Success','Blog Create Successful');

            return back();
            
            //message for list.blade.php
            // return back()->with([
            //     'success'=>'Insert data successfully'
            // ]);
        }
    }

    //function for validation
    private function validation ($validation){
        $rules = [
            'name' => 'required',
            'description' => 'required|',
            'image' => 'required|mimes:jpeg,jpg,png,gif'

        ];
        $message = [
            'name.required'=>'必須の名前',
            'description'=>'説明が必要です',
            'image.required'=>'画像が必要です'
        ];

        $validation-> validate($rules, $message);

    }
}
