<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CouresResource;
use App\Models\Coures;
use App\Models\User;
use App\Models\CouresComment;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CouresController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $success = Coures::where('sub_id', '=', $request->sub_id)->get();
        return $this->sendResponse(CouresResource::collection($success), 'course retrieved successfully.');
    }

    public function popularPost()
    {
        $comment = Comment::all();
        return $this->sendResponse($comment, 'Get all records.');
    }

    public function getCourse(Request $request)
    {
        $success = Coures::where('userID', '=', $request->userID)->get();
        return $this->sendResponse(CouresResource::collection($success), 'course retrieved successfully.');
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
            'title' => 'required',
            'body' => 'required',
            'sub_id' => 'required',
            'hastag' => 'required',
            'image'   => 'bail|required|string',
            'videoList' => 'required'
        ]);

   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $coures = Coures::create([
            'body' => request('body'),
            'title' => request('title'),
            'sub_id' => request('sub_id'),
            'hastag' => request('hastag'),
            'image' => request('image'),
            'videoList' => request('videoList'),
            'userID' => Auth::id(),
            'nameCreate' => Auth::user()->name,
        ]);
        
        return $this->sendResponse(new CouresResource($coures), 'course created successfully.');
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
        $coures = Coures::find($id);
        
        if (is_null($coures)) {
            return $this->sendError('Post not found.');
        }
        return $this->sendResponse(new CouresResource($coures), 'course retrieved successfully.');
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coures $coures)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'body' => 'required',
            'hastag' => 'required',
            'videoList' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        
        $coures->title = $input['title'];
        $coures->body = $input['body'];
        $coures->hastag = $input['hastag'];
        $coures->videoList = $input['videoList'];
        $coures->userID = Auth::id();
        $coures->save();

        return $this->sendResponse(new CouresResource($coures), 'course updated successfully.');
    }

    public function searchPost()
    {
        $search_text = $_GET['query'];
        
        $searchPost = Post::where('name','LIKE','%'.$search_text.'%')->get();
        
        dd($searchPost);
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coures = Coures::find($id);
        $all_comment = CouresComment::where('couresID', '=', $id)->get();
        
        foreach($all_comment as $comment)
        {
            $comment->delete();
        }

        $coures->delete();
        return $this->sendResponse([], 'Course deleted successfully.');
    }
}