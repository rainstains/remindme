<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use Auth;

class TaskController extends Controller
{
    //create
    public function create(Request $request){
      $task = new Task;
      $task->user_id = Auth::user()->id;
      $task->task_name = $request->task_name;
      $task->task_desc = $request->task_desc;
      $task->task_priority = $request->task_priority;
      $task->task_difficulty = $request->task_difficulty;
      $task->task_duedate = $request->task_duedate;
      $task->task_reminder = $request->task_reminder;
      $task->save();
      $task->user;
      return response()->json([
        'success' => true,
        'message' => 'Task Add to Database',
        'task' => $task
      ]);
    }

    //read
      //read one task
    public function getTask(Request $request){
      $task = Task::find($request->id);
      if ($task == null) {
        return response()->json([
          'success' => false,
          'task' => 'No Task'
        ]);
      }
      return response()->json([
        'success' => true,
        'task' => $task
      ]);
    }
      //read all data with Finnish state
      public function getFinnishTasks(){
        $tasks = Task::all()->where('task_state','=','Finnish');
        $countTasks = count($tasks);
        
        if ($tasks == null) {
          return response()->json([
            'success' => false,
            'tasks' => 'No Task'
          ]);
        }
        return response()->json([
          'success' => true,
          'count Tasks' => $countTasks,
          'tasks' => $tasks
        ]);
      }
      //read all data with OnGoing state and orderBy query
      public function getOnGoingTasks(Request $request){
        $priority_state = str_replace('"', "'", $request->priority);
        $diffculty_state = str_replace('"', "'", $request->difficulty);
        $date_state = str_replace('"', "'", $request->date);

        $tasks = Task::where('task_state','=','OnGoing')
        ->orderBy('task_priority', $priority_state)
        ->orderBy('task_difficulty', $diffculty_state)
        ->orderBy('task_duedate', $date_state)
        ->get();

        $countTasks = count($tasks);

        if ($tasks == null) {
          return response()->json([
            'success' => false,
            'tasks' => 'No Task'
          ]);
        }
        return response()->json([
          'success' => true,
          'count Tasks' => $countTasks,
          'tasks' => $tasks
        ]);
      }

    //update
      //update all colomun
    public function update(Request $request){
      $task = Task::find($request->id);
      if (Auth::user()->id != $task->user_id) {
        return response()->json([
          'success' => false,
          'message' => 'You Fail!'
        ]);
      }
      $task->task_name = $request->task_name;
      $task->task_desc = $request->task_desc;
      $task->task_priority = $request->task_priority;
      $task->task_difficulty = $request->task_difficulty;
      $task->task_duedate = $request->task_duedate;
      $task->task_reminder = $request->task_reminder;
      $task->update();
      return response()->json([
        'success' => true,
        'message' => 'Task has been Updated'
      ]);
    }
      //update finnish task
    public function finnished(Request $request){
      $task = Task::find($request->id);
      if (Auth::user()->id != $task->user_id) {
        return response()->json([
          'success' => false,
          'message' => 'You Fail! to finnish'
        ]);
      }
      $task->task_state = "Finnish";
      $task->update();
      return response()->json([
        'success' => true,
        'message' => 'Task is finnished'
      ]);
    }

    //delete
    public function delete(Request $request){
      $task = Task::find($request->id);
      if (Auth::user()->id != $task->user_id && $task->task_state != "Finnish") {
        return response()->json([
          'success' => false,
          'message' => 'You Fail!'
        ]);
      }
      $task->delete();
      return response()->json([
        'success' => true,
        'message' => 'Task has been Deleted'
      ]);
    }
}
