<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function signIn(Request $request){

      $credential = $request->only(['email','password']);

      if(!$token=auth()->attempt($credential)){
        return response()->json([
          'success' => false
        ]);
      }
      return response()->json([
        'success' => true,
        'token' => $token,
        'user' => Auth::user()
      ]);
    }

    public function signUp(Request $request){

        $passProtector =

        $user = new User;

        try {
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = $passProtector;
          $user->save();
          return $this->signIn($request);
        } catch (Exception $e) {
          return response()->json([
            'success' => false,
            'message' => $e
          ]);
        }

    }
}
