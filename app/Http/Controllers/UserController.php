<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        if($users)
        {
            return response()->json(['data' => $users, 'status' => 'success']);    
        }else
        {
            return response()->json(['status' => 'failed']);
        }
        
    }

    public function userId(Request $request)
    {
        $user = User::find($request->user_id);
        if($user)
        {
            return response()->json(['data' => $user, 'status' => 'success']);
        }else
        {
            return response()->json(['status' => 'failed']);
        }
        
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'password' => 'required | string ',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        $user = User::create([
            'id' => uuid(),
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        if($user)
        {
            return response()->json(['data' => $user, 'status' => 'success']);
        }else
        {
            return response()->json(['status' => 'failed']);
        }
        
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'password' => 'required',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        $user = User::find($request->user_id);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if($result)
        {
            return response()->json(['data' => $result, 'status' => 'success']);
        }else
        {
            return response()->json(['status' => 'failed']);
        }        
    }

    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        $user = User::find($request->user_id);
        $user->username = $request->username;
        $result = $user->save();
        if($result)
        {
            return response()->json(['data' => $result, 'status' => 'success']);
        }else
        {
            return response()->json(['status' => 'failed']);
        }        
    }

    public function delete(Request $request)
    {
        $user = User::find($request->user_id);
        $result = $user->delete();
        if($result)
        {
            return response()->json(['data' => $result, 'status' => 'Record has been deleted']);
        }else 
        {
            return response()->json(['status' => 'failed']);
        }        
    }

    public function deleteUsers(Request $request)
    {
        
        $ids = explode(',', $request->users_id);
        $result = User::whereIn('id', $ids)->delete();

        if($result)
        {
            return response()->json(['msg' => 'Record has been deleted', 'status' => 'Success']);
        }else 
        {
            return response()->json(['status' => 'failed']);
        }        
    }

    public function login(Request $request)
    {
        
        $user = User::where('username', $request->username)->first();
        if(!$user|| !Hash::check($request->password, $user->password))
        {
            return response([
                'msg' => "Please check your login credentials"
            ], 404);
        }
        
        $token = $user->createToken('my-app-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
