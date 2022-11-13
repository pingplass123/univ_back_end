<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $success['all_Post'] = Post::where('sub_id', '=', $request->sub_id)->get();
        // return $this->sendResponse($success, 'Get all post records.');

        $success = Post::where('sub_id', '=', $request->sub_id)->get();
        // return $this->sendResponse($success, 'Get all post records.');
        return $this->sendResponse(PostResource::collection($success), 'Post retrieved successfully.');
    }

    public function popularPost()
    {
        $comment = Comment::all();
        return $this->sendResponse($comment, 'Get all records.');
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
            
        ]);

   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $post = Post::create([
            'body' => request('body'),
            'title' => request('title'),
            'sub_id' => request('sub_id'),
            'hastag' => request('hastag'),
            'image' => request('image'),
            'userID' => Auth::id(),
            'nameCreate' => Auth::user()->name,
        ]);
        
        return $this->sendResponse(new PostResource($post), 'Post created successfully.');
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
        $post = Post::find($id);
        
        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }
        return $this->sendResponse(new PostResource($post), 'Post retrieved successfully.');
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'body' => 'required',
            'hastag' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        
        $post->title = $input['title'];
        $post->body = $input['body'];
        $post->hastag = $input['hastag'];
        $post->userID = Auth::id();
        $post->save();

        return $this->sendResponse(new PostResource($post), 'Post updated successfully.');
    }

    public function searchPost()
    {
        $search_text = $_GET['query'];
        
        $searchPost = Post::where('name','LIKE','%'.$search_text.'%')->get();
        
        dd($searchPost);
    }

    public function getPost(Request $request)
    {
        $success = Post::where('userID', '=', $request->userID)->get();
        return $this->sendResponse(PostResource::collection($success), 'Post retrieved successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
   
        return $this->sendResponse([], 'Post deleted successfully.');
    }
}