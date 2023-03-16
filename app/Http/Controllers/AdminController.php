<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        $admin = Admin::where('username', $request->username)->first();
        if(!$admin|| !Hash::check($request->password, $admin->password))
        {
            return response([
                'msg' => "Please check your login credentials"
            ], 404);
        }
        
        $token = $admin->createToken('my-app-token')->plainTextToken;

        return response()->json([
            'user' => $admin,
            'token' => $token,
        ]);
    }
}
