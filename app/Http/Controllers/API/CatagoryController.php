<?php

namespace App\Http\Controllers\API;


   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CatagoryResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Catagory;
use App\Models\User;
use App\Models\Subcategories;

class CatagoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catagory = Catagory::all();
    
        return $this->sendResponse(CatagoryResource::collection($catagory), 'Catagory retrieved successfully.');
    }

    public function queryCategoryDesign()
    {
        $id = 1;
        $data = Subcategories::all();
        return $this->sendResponse(SubcategoryResource::collection($data), 'Catagory retrieved successfully.');

    }

    public function queryCategoryDevelopment()
    {
        dd("queryCategoryDevelopment");
    }

    public function queryCategoryMaketing()
    {
        dd("queryCategoryMaketing");
    }

    public function queryCategorySoftware()
    {
        dd("queryCategorySoftware");
    }

    public function queryCategoryPersernal()
    {
        dd("queryCategoryPersernal");
    }

    public function queryCategoryBusiness()
    {
        dd("queryCategoryBusiness");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();
   
        // $validator = Validator::make($input, [
        //     'title' => 'required',
        //     'body' => 'required',
            
        // ]);
   
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
        
        // $post = Post::create([
        //     'body' => request('body'),
        //     'title' => request('title'),
        //     'userID' => Auth::id()
        // ]);
    
        
        // return $this->sendResponse(new PostResource($post), 'Post created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user = Auth::user(); 
        //dd($user);
        $catagory = Catagory::find($id);
        
  
        if (is_null($catagory)) {
            return $this->sendError('Catagory not found.');
        }
   
        return $this->sendResponse(new CatagoryResource($catagory), 'Catagory retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catagory $catagory)
    {
        // $input = $request->all();
        
        // $validator = Validator::make($input, [
        //     'title' => 'required',
        //     'body' => 'required',
            
        // ]);
        
        // if($validator->fails()){
        //     dd($input);
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }

        // $post->title = $input['title'];
        // $post->body = $input['body'];
        // $post->userID = Auth::id();
        // $post->save();
   
        // return $this->sendResponse(new PostResource($post), 'Post updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catagory $catagory)
    {
       
    }
}
