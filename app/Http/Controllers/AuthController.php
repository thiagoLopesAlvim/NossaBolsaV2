<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credenciais = [
            'Login' => $request->login,
            'Senha' => $request->senha
        ];

        $dadoCriptografado = DB::table('FAESA_LOGIN_NOSSABOLSA')
            ->select('Senha')
            ->where('Login', "administrador")
            ->first();
        
        $senhaCriptografada = $dadoCriptografado->Senha;
        
        $descriptografia = $this->descriptografar($senhaCriptografada);

        if (($credenciais['Login'] == 'administrador' && $credenciais['Senha'] == $descriptografia[""])) {
            $sucesso = false;
            return view('Menu', compact('sucesso'));
        } else {
            // Autenticação falhou
            return redirect()->back()->with('error', 'Credenciais inválidas.');
        }
    }

    public function descriptografar($senhaCriptografada)
    {
        $descriptografia = User::select(DB::raw("dbo.decrypt('$senhaCriptografada')"))
            ->first()->toArray();
        return $descriptografia;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
