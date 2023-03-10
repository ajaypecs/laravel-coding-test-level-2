<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:projects',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        Project::create([
            'id' => uuid(),
            'name' => $request->name,
        ]);

        return 'Successfully Create Project';
    }
}
