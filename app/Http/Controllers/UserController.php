<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function index()
    {
        return $this->user->all();
    }

    public function show($id,Request $request){

        $user = $this->user->find($id);

        return response($user);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=>'required'            
        ]);
        $data['password'] = Crypt::encrypt($data['password']);
        $data['is_active'] = true;
        $this->user->create($data);
        return response(['message' => 'Usuário criado com sucesso!'],201);
    }

    public function update($id,Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required',
            'is_active'=>'required'
        ]);

        $user = $this->user->find($id);
        $user->update($request->all());
        $user->save();

        return response(['message'=>'Usuário alterado com sucesso!','user'=>$user]);
    }

    public function destroy($id){
        $user = $this->user->find($id);
        $user->delete();
        return response(['message'=>'Usuário removido com sucesso!']);
    }
}
