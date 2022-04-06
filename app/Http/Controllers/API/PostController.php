<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
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
    public function index()
    {
        $posts = Post::all();
    
        return $this->sendResponse(PostResource::collection($posts), 'Post retrieved successfully.');
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
            // 'image'   => 'required|max:10000',
            
        ]);
    //    dd($request);
        
        $image = $request->file('image');
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        // dd($new_name);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $post = Post::create([
            'body' => request('body'),
            'title' => request('title'),
            'sub_id' => request('sub_id'),
            'hastag' => request('hastag'),
            'image' => $imageName,
            'userID' => Auth::id()
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