<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Mockery\Exception;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Symfony\Component\HttpFoundation\Response;

class EmailVerificationController extends Controller
{   
    public function sendVerificationEmail(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                return response()->json(['message' => 'Already verified'], Response::HTTP_BAD_REQUEST);
            }
    
            $request->user()->sendEmailVerificationNotification();
            
            return response()->json(['message' => 'Verification link sent!'], Response::HTTP_OK);

        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function verify(Request $request)
    {
        $user = User::findOrFail($request->route("id"));

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], Response::HTTP_BAD_REQUEST);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(['message' => 'Email has been verified'], Response::HTTP_OK);
    }
}
