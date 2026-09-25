<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $apiToken;
    public function __construct()
     {
       $this->apiToken = uniqid(base64_encode(Str::random(40)));
       $this->middleware('auth:api', ['except' => ['login', 'register']]);
     }

public function login(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | Validate Login Fields
    |--------------------------------------------------------------------------
    */

    $validator = Validator::make($request->all(), [

        'email' => 'required|email',

        'password' => 'required|string|min:8',

    ]);


    if ($validator->fails()) {

        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422);
    }


    /*
    |--------------------------------------------------------------------------
    | Find User
    |--------------------------------------------------------------------------
    */

    $user = User::where(
        'email',
        $request->email
    )->first();


    /*
    |--------------------------------------------------------------------------
    | User Doesn't Exist / Wrong Password
    |--------------------------------------------------------------------------
    */

    if (
        !$user ||
        !Hash::check(
            $request->password,
            $user->password
        )
    ) {

        return response()->json([
            'status' => 'error',
            'data' => 'Invalid email or password.',
        ], 401);
    }


    /*
    |--------------------------------------------------------------------------
    | Email Verification Check
    |--------------------------------------------------------------------------
    */

    if (!$user->email_verified_at) {

        return response()->json([
            'status' => 'error',

            'data' =>
                'Please verify your email address before logging in.',

            'email_verified' => false,

        ], 403);
    }


    /*
    |--------------------------------------------------------------------------
    | Account Status Check
    |--------------------------------------------------------------------------
    */

    if ($user->status != 1) {

        return response()->json([
            'status' => 'error',

            'data' =>
                'Unauthorized Access. Please contact admin.',

        ], 403);
    }


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    Auth::login($user);


    /*
    |--------------------------------------------------------------------------
    | Setting Login Response
    |--------------------------------------------------------------------------
    */

    $success['token'] = $this->apiToken;

    $success['name'] = $user->name;


    return response()->json([

        'status' => 'success',

        'data' => $success,

        'user' => $user,

    ]);
}

public function register(Request $request)
{
    // Validate registration data
    $validator = Validator::make($request->all(), [

        'first_name' => 'required|string|max:255',

        'last_name' => 'required|string|max:255',

        'email' => 'required|email|unique:users,email',

        'phone' => 'required|string|max:20',

        'password' => 'required|string|min:8|confirmed',

        'terms' => 'required|accepted',

    ]);


    // Return validation errors
    if ($validator->fails()) {

        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422);
    }


    // Create user
    $user = User::create([

        'first_name' => $request->first_name,

        'last_name' => $request->last_name,

        'email' => $request->email,

        'phone' => $request->phone,

        'password' => Hash::make($request->password),

        'role_id' => 3,

        'status' => 2,

        // Important:
        // Leave email_verified_at NULL
        // until the user clicks the email link.

        'email_verified_at' => null,

    ]);


    /*
    |--------------------------------------------------------------------------
    | Create verification URL
    |--------------------------------------------------------------------------
    */

        // 🔐 CREATE SIGNED VERIFICATION LINK
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id'   => $user->id,
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        // 📧 SEND EMAIL MANUALLY
        Mail::to($user->email)->send(
            new VerifyEmailMail($verificationUrl)
        );


    /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    */

    return response()->json([

        'status' => 'success',

        'message' =>
            'Account created successfully. ' .
            'Please check your email to verify your account.',

        'data' => [

            'name' =>
                $user->first_name . ' ' .
                $user->last_name,

            'email' => $user->email,

        ],

    ]);
}

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->flush();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function userProfile() {
        return response()->json(auth()->user());
    }
}
