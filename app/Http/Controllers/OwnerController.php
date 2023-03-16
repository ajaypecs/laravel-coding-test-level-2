<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use Hash;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
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

        $owner = Owner::where('username', $request->username)->first();
        if(!$owner|| !Hash::check($request->password, $owner->password))
        {
            return response([
                'msg' => "Please check your login credentials"
            ], 404);
        }
        
        $token = $owner->createToken('my-app-token')->plainTextToken;

        return response()->json([
            'id' => uuid(),
            'user' => $owner,
            'token' => $token,
        ]);
    }
}
