<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function master(){
        return view('Layouts/master');
    }

    public function list (){
        return view('main/list');
    }

    public function form(Request $request){
        // dd($request->toArray());?

        // $this->validation($request); //use the valitation function

        // return 'success';
        return $request;

         $fromData = [
            'name'=>$request->name,
            'descrption'=>$request->description,
            'image'=>$request->file('image'),
            'owner_name'=>$request->ownerName,
        ];

        $name = $request->name;
        $description = $request->description;
        $image = $request->file('image');
        $ownerName = $request->ownerName;

        // dd($name, $description, $image, $ownerName);

        if (($name && $description && $image) == null){
            $this->validation($request);
        }else{
            if($request->hasFile('image')){
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/image/',$imageName);
            
            $data = [
                'name'=>$request->name,
                'descrption'=>$request->description,
                'image'=>$imageName,
                'owner_name'=>$request->ownerName,
            ];

            dd($data);
        }else{
             return ("Image file doesn't have");
        }
        }
    }

    //function for validation
    private function validation ($validation){
        $rules = [
            'name' => 'required',
            'description' => 'required|',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'

        ];
        $message = [
            'name.required'=>'必須の名前',
            'description'=>'説明が必要です',
            'image.required'=>'画像が必要です'
        ];

        $validation-> validate($rules, $message);

    }
}
