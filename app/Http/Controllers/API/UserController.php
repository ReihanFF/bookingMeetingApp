<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
        $credentials = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)) {
            $success = true;
            $message = "Guest berhasil login";
        } else {
            $success = false;
            $message = "unauthorized";
        }

        $reponse = [
            'success' => $success,
            'message' => $message
        ];

        return reponse()->json($reponse);
    }

    public function register(Request $request) {
        try {
            $guest = new guest();
            $guest->nama = $request->nama;
            $guest->email = $request->email;
            $guest->password = Hash::make($request->password);
            $guest->save();

            $success = true;
            $message = "Guest Berhasil dibuat";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $reponse = [
            'success' => $success,
            'message' => $message
        ];

        return reponse()->json($reponse);
    }

    public function logout() {
        try {
            Session::flush();
            $success = true;
            $message = "Berhasil logout";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $reponse = [
            'success' => $success,
            'message' => $message
        ];

        return reponse()->json($reponse);
    }
}
