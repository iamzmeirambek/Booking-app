<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Jobs\SendPasswordJob;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request){

        $user = User::query()->create($request->validated());
        $user->assignRole(2);
        $token = $user->createToken('apiToken')->plainTextToken;
        $res = [
            'user' => $user,
            'token' => $token,
        ];
        return response($res, 201);

    }

    public function login(LoginRequest $request){


        $user = User::query()->where('email', $request['email'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'msg' => 'incorrect username or password'
            ], 401);
        }

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];

        return response($res, 201);
    }

    public function forgot_password(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);
        $data['email']=$request->email;
        $data['token']=$token;
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        SendPasswordJob::dispatch($data);
        return response()->json([
            'message' => 'We have e-mailed your password reset link!',
            'token' => $token
        ],203);

    }
    public function reset_password(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|',
            'password_confirmation' => 'required|same:password'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword &&
            $updatePassword->activated_at === null &&
            $updatePassword->created_at < Carbon::now()->subDay()){
            return response()->json([
                'error' => 'Invalid token!'
            ]);
        }

        $user = User::query()->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'message' => 'Your password updated!'
        ]);
    }
        public function logout(Request $request)
        {
            auth()->user()->tokens()->delete();
            return [
                'message' => 'user logged out'
            ];
        }
}
