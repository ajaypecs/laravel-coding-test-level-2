<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|required',
            'description' => 'string',
            'status' => '   required|string',
            'project_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        Task::create([
            'id' => uuid(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
        ]);

        return 'Successfully Create the Task';
    }
}
