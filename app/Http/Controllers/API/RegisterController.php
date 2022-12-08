<?php

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if (User::where('email', '=', $request->get('email'))->exists()) {
            return $this->sendError([],'Sorry user already exists');
         }else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['id'] = $user->id; 
            return $this->sendResponse($success, 'User register successfully.');
         }
   
       
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            // if(Auth::role() == "admin"){
                // TODO
            // } 
            
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['id'] = $user->id;
            
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('อีเมล์หรือรหัสผ่านไม่ถูกต้อง.', ['error'=>'อีเมล์หรือรหัสผ่านไม่ถูกต้อง']);
        } 
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout Successfully.'], 200);
    }

}