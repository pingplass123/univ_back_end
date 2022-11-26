<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CommentResource;
use App\Models\Coures;
use App\Models\CouresComment;
use Validator;
use Auth;



class CommentCourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $success['all_comment'] = CouresComment::where('couresID', '=', $request->couresID)->get();
        return $this->sendResponse($success, 'Get all comment course records.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'description' => 'required',
            'score' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $comment = CouresComment::create([
            'couresID'=> request('couresID',$request),
            'description' => request('description'),
            'score' => request('score'),
            'userID' => Auth::id(),
            'nameCreate' => Auth::user()->name,
        ]);
    
        
        return $this->sendResponse($comment, 'Comment created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $comment = CouresComment::find($id);
        
        if (is_null($comment)) {
            return $this->sendError('Comment not found.');
        }
        return $this->sendResponse(new CommentResource($comment), 'Comment retrieved successfully.');

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    // public function update(Request $request, Comment $comment)
    // {
    //     $input = $request->all();
        
    //     $validator = Validator::make($input, [
    //         'description' => 'required',
    //         'score' => 'required',
            
    //     ]);
        
    //     if($validator->fails()){
    //         dd($input);
    //         return $this->sendError('Validation Error.', $validator->errors());       
    //     }

    //     $comment->description = $input['description'];
    //     $comment->score = $input['score'];
    //     $comment->PostID = $input['postID'$request];
    //     $comment->save();
   
    //     return $this->sendResponse(new CommentResource($comment), 'Comment updated successfully.');

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $success['delete'] = CouresComment::where('id', '=', $request->id)->delete();
        return $this->sendResponse($success, 'Comment  Course deleted successfully.');
    }


    
}