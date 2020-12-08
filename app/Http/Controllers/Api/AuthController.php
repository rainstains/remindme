<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;

class AuthController extends Controller
{
    public function signIn(Request $request){

      $credential = $request->only(['email','password']);

      if(!$token=auth()->attempt($credential)){
        return response()->json([
          'success' => false,
          'message' => 'Invalid Credential'
        ]);
      }
      return response()->json([
        'success' => true,
        'token' => $token,
        'user' => Auth::user()
      ]);
    }

    public function signUp(Request $request){

        $passProtector = Hash::make($request->password);

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
            'message' => ' '.$e
          ]);
        }

    }

    public function signOut(Request $request){
      try {
        JWTAuth::invalidate(JWTAuth::parseToken($request->token));
        return response()->json([
          'success' => true,
          'message' => 'logout success'
        ]);
      } catch (Exception $e) {
        return response()->json([
          'success' => false,
          'message' => ' '.$e
        ]);
      }

    }
}
