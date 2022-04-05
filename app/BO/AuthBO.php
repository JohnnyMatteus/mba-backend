<?php

namespace App\BO;

use Carbon\Carbon;
use App\Model\User;
use App\Http\Requests;
use Illuminate\Support\Str;
use App\Model\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Illuminate\Database\Eloquent\Collection;

class AuthBO
{

    private $prosseguir;
    private $data;
    private $auth;

    public function cadastrarUsuario($request)
    {
        $objeto = new \stdClass();
        // Verificação de dados basico para cadastro
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        // Criptografando senha
        $validatedData['password'] = bcrypt($request->password);
        // Criando novo usuário
        $objeto->user = User::create($validatedData);
        // Adicionando permissão de visitante
        $objeto->user->roles()->attach(2);
        // Criando array de dados de acesso
        $accessToken = $objeto->user->createToken('authToken')->accessToken;

        return $accessToken;
    }

    public function logar($request)
    {
        $objeto = new \stdClass();
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($loginData))
        {
            $objeto->message = 'Invalid Credentials';
            $objeto->status = false;
        } else {
            $objeto->access_token = auth()->user()->createToken('authToken')->accessToken;
            $objeto->status = true;
        }
        return $objeto;
    }

    public function recuperarSenha($request)
    {
        $data = new \stdClass();
        
        try {
            $request->validate(['email' => 'required|email']);
            $user = User::where("email", $request->email)->first();
            if (!$user)
            {
                $data->message = "Não conseguimos encontrar um usuário com esse endereço de e-mail.";
                $data->codigo = false;
                return $data;
            }

            $passwordReset = PasswordReset::firstOrCreate(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'token' => Str::random(60)
                ]
            );
            
            if ($user && $passwordReset)
                $user->notify(
                    new PasswordResetRequest($passwordReset->token)
                );
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function validarToken($request)
    {
        $data = new \stdClass();
        $passwordReset = PasswordReset::where('token', $request->token)->first();

        if (!$passwordReset) {
            $data->message = 'Este token de redefinição de senha é inválido.';
            $data->codigo =  false;
            return $data;
        }

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            $data->message = 'O token de redefinição de senha dele é inválido.';
            $data->codigo =  false;
            return $data;
        }
        $data->message = 'Token válido';
        $data->codigo =  true;
        return $data;
    }

    public function registrarSenha($request)
    {
        $data = new \stdClass();
        $validatedData = $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $passwordReset = PasswordReset::where([
            ['token', $request->token]
        ])->first();

        if (!$passwordReset) {
            $data->message = "Este token de redefinição de senha é inválido.";
            $data->codigo = false;
            return $data;
        }
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            $data->message = "Não conseguimos encontrar o usuário com esse endereço de e-mail.";
            $data->codigo = false;
            return $data;
        }

        $user->password = Hash::make($request->confirmpassword);
        $user->save();

        PasswordReset::where('email', $passwordReset->email)->delete();
        
        $user->notify(new PasswordResetSuccess($passwordReset));
        
        $data->message = "Sua senha foi alterada com sucesso.";
        $data->codigo = true;
        return $data;
    }

    public function logOut()
    {
        try {
            $usuario      = Auth::user();
            if ($usuario) {
                $usuario->token()->revoke();
            }
            return response()->json(["message" => "disconnected"], 200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage());
        }
    }

}