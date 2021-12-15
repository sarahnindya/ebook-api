<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function me(){
        return[
            'status' => '200',
            'message' => 'success',
            'Nis' => '3103119184',
            'Nama' => 'Sarah Nindya Pramesthi',
            'Kelas' => 'XII RPL 6',
            'Absen' => '01',
            'TTL' => 'Tegal, 15 Oktober 2004'
        ];
    }
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required', 
            'password' => 'required|confirmed'

        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('apptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out',

        ];
    }
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required', 
            'password' => 'required'

        ]);
        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'bad crecidentials'
            ], 401); 

        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
}
