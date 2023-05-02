<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Mockery\Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller 
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|max:50|min:8'
        ], []);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('authtoken')->accessToken;

        return response()->json([
            'message'   => 'User Registered',
            'data'      => [
                            'access_token' => $token, 
                            'user' => $user
                        ]
        ], Response::HTTP_OK);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|max:255',
            'password' => 'required|min:8|max:20',
        ], []);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);

        }

        $credentials = [
            'email'      => $request['email'],
            'password'   => $request['password'],
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json('Incorrect account or password information', Response::HTTP_UNAUTHORIZED);
        }

        $token = $request->user()->createToken('authtoken')->accessToken;
        $user = Auth::user();
        $data = $user->toArray();

        return response()->json(
            [
                'message'=>'Logged in successfully',
                'data'=> [
                    'user'=> $data,
                    'access_token'=> $token
                ]
            ]
        , Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function logout() {
        auth('api')->logout();
        return response()->json('Logout success !', Response::HTTP_OK);
    }
}
