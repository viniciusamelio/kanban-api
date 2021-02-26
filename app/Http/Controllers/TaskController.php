<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller{

    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index(){
        return $this->task->all();
    }

    public function show($id){
        $task = $this->task->find($id);
        if($task == null) return response(['message'=>'Task não encontrada!'],404);
        return $task;
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status'=>'required'            
        ]);
        $this->task->create($request->all());
        return response(['message'=>'Task criada com sucesso!'],201);
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status'=>'required'            
        ]);
        $task = $this->task->find($id);
        if($task == null) return response(['message'=>'Task não encontrada!'],404);
        $task->update($request->all());
        $task->save();

        return response(['message'=>'Task alterada com sucesso!', 'task'=>$task]);
    }

    public function destroy($id){
        $task = $this->task->find($id);
        if($task == null) return response(['message'=>'Task não encontrada!'],404);
        $task->delete();
        return response(['message'=>'Task removida com sucesso!']);
    }

}