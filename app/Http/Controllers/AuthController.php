<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{

    public function authenticate(Request $request)
    {
        $user = User::where('email', $request->only('email'))->first();
        if ($user == null) return response(['message' => 'Usuário não encontrado!'], 404);
        $passwordMatch = $this->comparePassword($user->passwordHash(), $request->only('password')['password']);
        if (!$passwordMatch) return response(['message' => 'Usuário ou senha incorretos!'], 401);
        return response(['message' => 'Logado com sucesso!', 'user'=>$user]);
    }

    private function comparePassword($hash, $password): bool
    {
        try {
            $decryptedPassword = Crypt::decrypt($hash);
            if ($decryptedPassword != $password) return false;
            return true;
        } catch (DecryptException $th) {
            return false;
        }
    }
}
