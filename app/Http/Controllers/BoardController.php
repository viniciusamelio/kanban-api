<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class BoardController extends Controller{

    private $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function index(){
        return $this->board->all();
    }

    public function indexByUser($id, Request $request){
        $boards = $this->board->select('*')
        ->where('user_id','=' ,$id)
        ->get();

        return response($boards);
    }

    public function show($id, Request $request){
        $board = $this->board->find($id);
        if($board == null) return response(['message'=>'Board não encontrado!'],404);
        $board['tasks'] = $board->tasks;
        return response($board);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'color'=>'required',
            'user_id'=>'required'      
        ]);
        $board = $this->board->create($request->all());
        return response(['message'=>'Board criado com sucesso!','board'=>$board],201);
    }

    public function update($id,Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'color'=>'required',
            'user_id'=>'required'  
        ]);
        $board = $this->board->find($id);
        if($board == null) return response(['message'=>'Board não encontrado!'],404);
        $board->update($request->all());
        $board->save();


        return response(['message'=>'Board atualizado com sucesso!','board'=>$board]);
    }

    public function destroy($id){
        $board = $this->board->find($id);
        if($board == null) return response(['message'=>'Board não encontrado!'],404);
        $board->delete();

        return response(['message'=> 'Board removido com sucesso!']);
    }
}