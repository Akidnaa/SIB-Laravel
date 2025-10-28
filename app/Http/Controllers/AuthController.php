<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function register (Request $request) {
         //1. Set Up Validator
         $validator = Validator::make($request->all(), [
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|max:255|unique:users',
            'password'=> 'required|min:8'
         ]);
         
         //2. Cek Validator
         if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
         }

         //3. Create user
         $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => bcrypt($request->password)
         ]);

         //4. Cek keberhasilan
         if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
         }

         //5. Cek gagal
         return response()->json([
            'success' => false,
            'message' => "user creation failed",
         ], 409);//conflict
    }

    public function login(Request $request) {
         //1. Set up Validator
         $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
         ]);
         
         //2. Check Validator
         if ($validator->fails()) {
            return response()->json($validator->errors());
         }
         
         //3. Get Credential From Request
         $credentials = $request->only('email','password');
         
         //4. Check isFailed
         if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
               'success'=> false,
               'message' => 'Email atau Password Anda Salah!',
            ], 401);
         }
         //5. Check isSuccess
         return response()->json([
            'success' => true,
            'message' => 'Login Succesfully',
            'user' => auth()->guard('api')->user(),
            'token' => $token,
         ], 200);      
      }

      public function logout(Request $request) {
         //try
         // 1. Invalidate Token
         // 2. cek isSuccess

         // catch
         // 1. cek isFailed

         try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
               'success' => true,
               'message' => 'Logout successfully'
            ], 200);
         } catch (JWTException $e) {
            return response()->json([
               'success' => false,
               'message' => 'Logout failed!'
            ], 500);
         }
      }
   }
