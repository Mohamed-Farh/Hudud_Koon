<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Categories_media;
use App\Models\Category;
use App\Models\Region;
use App\User;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try{
            $categories = Category::orderBy('id', 'desc')->get();

            return view('pages.admin.categories.index', compact('categories'));
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function create()
    {
        $users = User::orderBy('id', 'desc')->get();

        $regions = Region::orderBy('id', 'desc')->pluck('name', 'id');

        return view('pages.admin.categories.create', compact('users', 'regions') );
    }




    public function store(Request $request)
    {
        try{

            //To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath =('image/category/photo');
                $image->move($destinationPath, $name);
                $photo=$name;
            }

            $category = new Category();
            $category->photo             = $photo;
            $category->name              = $request->name;
            $category->save();


            if($files=$request->file('images')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $fileextention =$file->getClientOriginalExtension();  //get Extention of Image
                    $file_to_store=time().'_'.explode('.',$name)[0].'_.'.$fileextention;

                    $file->move('image/category/images',$file_to_store);
                    Categories_media::create([
                        'path' => 'image/category/images/'.$file_to_store,
                        'category_id'=>$category->id,
                    ]);
                }
            }

            toastr()->success('message', 'Category created successfully.');
            return redirect()->route('categories.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Property $property)
    // {
    //     return view('pages.admin.properties.show', compact('property'));

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('pages.admin.categories.edit', compact('category'));

    }


    public function update(Request $request)
    {



        try {
            $category = Category::where('id', $request->id)->first();

            // To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath =('image/category/photo');

                if ( $image->move($destinationPath, $name) ){
                    if($category->photo){
                    $old_photo = $category->photo; //get old photo
                    unlink('image/category/photo/'.$old_photo);  //delete old photo from folder
                    }
                    $category->photo = $name;
                    $category->save();
                }
            }

            $category->update([
                $category->name              = $request->name,
            ]);

            if($files=$request->file('new_images')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $fileextention =$file->getClientOriginalExtension();  //get Extention of Image
                    $file_to_store=time().'_'.explode('.',$name)[0].'_.'.$fileextention;

                    $file->move('image/category/images',$file_to_store);
                    Categories_media::create([
                        'path' => 'image/category/images/'.$file_to_store,
                        'category_id'=>$category->id,
                    ]);
                }
            }
            // dd($name);
            toastr()->success('message', 'Property Updated successfully.');
            return redirect()->route('categories.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {
        try {
            $category = Category::findOrFail($request->id);

            if ($category) {
                foreach ($category->categories_media as $images) {
                    unlink($images->path);
            }

            if($category->photo)
            {
                if (File::exists('image/category/photo/' .$category->photo) ) {
                    unlink('image/category/photo/'.$category->photo);
                }
            }
            $category->delete();

            toastr()->error(trans('messages.Delete'));
            return redirect()->route('categories.index');
            }
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function category_visible(Request $request)
    {
        try {
            $category = Category::findOrFail($request->id);

            if($category->status == '0'){
                $category->update([
                    $category->status = '1',
                ]);
            }elseif($category->status == '1'){
                $category->update([
                    $category->status = '0',
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function removeImage(Request $request )
    {
        $image = Categories_media::whereId($request->key)->first();
        if ($image) {
            if (File::exists($image->path)) {
                unlink($image->path);
            }
            $image->delete();
            return true;
        }
        return false;
    }

    public function deleteimg($id)
    {
        try {
            $gallery = Categories_media::findOrFail($id);

            if($gallery)
            {
                unlink($gallery->path);
                $gallery->delete();

                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
            }
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
