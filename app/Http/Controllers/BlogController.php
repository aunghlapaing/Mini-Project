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
                ->when(request('searchKey'),function($query){
                    // $query->orWhere('name', 'like', '%'.request('searchKey').'%');
                    // $query->orWhere('description', 'like', '%'.request('searchKey').'%');

                    $query->whereAny(['name', 'description'], 'like', '%'.request('searchKey').'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(2);

        return view('main/list',compact('blogs'));
    }

    public function delete($id){
        // dd($id);
        $imageName = Blog::where('id', $id)->value('image'); //find() is bug && Query builder

        // dd($imageName);
        unlink(public_path('image/'.$imageName)); //delete locally

        $deleteData = Blog::where ('id', $id)->delete(); //delete on database

        return back();
    }

    // retrun data from list using parameter passing
    public function update($id){
        $blog = Blog::where ('id',$id)->first();

        // dd($blog);
        return view('main/update', compact('blog'));
    }

    // update data from form into table using query builder
    public function formUpdate(Request $request, $id){
        // return 'formUpdate';
        // dd ($request->all(), $id);
        $request['id'] = $id;

        $this->validation($request, 'update');

        $data = $this->getFromData($request);

        if($request->hasFile('image')){
            $oldImage = $request->oldImage; //old image from hidded input

            // dd($oldImage);

            if(file_exists(public_path('image/'. $oldImage))){
                unlink(public_path('image/'. $oldImage));
            }

            $file_name = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/image/',$file_name);

            $data['image'] = $file_name;

        }

        $updateData = Blog::where('id', $id)->update($data);

        
        //sweet alert message
        alert()->success('Success','Blog Update Successful');

        return to_route('list');
        
        

    }

    private function getFromData ($data){
        return [
            'name' => $data->name,
            'description' => $data->description,
            'owner_name' => $data->ownerName,
        ];
    }

    public function formCreate(Request $request){
        // dd($request->toArray());?

        // $this->validation($request); //use the valitation function

        // return 'success';

        $name = $request->name;
        $description = $request->description;
        $image = $request->file('image');
        $ownerName = $request->ownerName;

        // dd($name, $description, $image, $ownerName);

        if (($name && $description && $image) == null){
            $this->validation($request, 'create');
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
            
            //message for list.blade.php manaully
            // return back()->with([
            //     'success'=>'Insert data successfully'
            // ]);
        }
    }

    public function detail($id){
        $detail = Blog::where('id', $id)->first();
        // dd($detail);
        return view('main/detail', compact('detail'));
    }

    //function for validation
    private function validation ($validation, $action){
        $rules = [
            'name' => 'required|unique:blogs,name, '.$validation->id,
            'description' => 'required|',
        ];

        $rules ['image'] = $action == 'create' ? 'required|mimes:jpeg,jpg,png,gif' : '' ;

        $message = [
            'name.required'=>'必須の名前',
            'description'=>'説明が必要です',
            'image.required'=>'画像が必要です'
        ];

        $validation-> validate($rules, $message);

    }
}
