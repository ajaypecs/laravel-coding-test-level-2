<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        // return User::all();
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'string',
            'project_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        $task = Task::create([
            'id' => uuid(),
            'title' => $request->title,
            'description' => $request->description ? $request->description:'',
            'status' => 'NOT_STARTED',
            'project_id' => UUID($request->project_id),
            'user_id' => UUID($request->user_id),
        ]);

        if($task)
        {
            return response()->json(['data' => $task, 'status' => 'success']);
        }else
        {
            return response()->json(['status' => 'failed']);
        }
        
    }

    public function updateTask(Request $request)
    {
        // return Task::get();
        $validator = Validator::make($request->all(), [
            'task_id' => 'required',
            'status' => 'required|string',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        $valid = array("NOT_STARTED", "IN_PROGRESS", "READY_FOR_TEST", "COMPLETED");
 
        if (in_array($request->status, $valid)) {
            
            $task = Task::find($request->task_id);
            $task->status = $request->status;
            $task->save();
            return response()->json(['data' => $task, 'status' => 'success']);
            
        } else {
            return response()->json(['error' => 'Please check your details', 'status' => 'failed']);
        }
        
        
        return $task;
    }
}
