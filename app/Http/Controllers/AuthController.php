<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth, Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class AuthController extends Controller
{
    private $response;
    /**
     * Function : Signup 
     * @param \Illuminate\Http\Request
     */
    public function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6'],
            'emp_code' => 'required|unique:users',
            'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'vaidation error found.',
                'errors' => $validator->errors()->all()
            ], 422);
        }
        DB::beginTransaction();
        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            //Password and Confirm Password check here
            if (trim($request->password) != trim($request->confirm_password)) {
                return response()->json(['status' => 'failed', 'message' => 'Password does not match.'], 401);
            }
            //dd($request->confirm_password);
            $user->password = Hash::make($request->password);
            $user->emp_code = $request->emp_code;
            $user->user_type = $request->user_type;
            //$user->created_by = ($request->created_by == "") ? '' : $request->created_by;
            //$user->updated_by = ($request->updated_by == "") ? '' : $request->updated_by;
            $user->save();

            $token = $user->createToken($request->name)->plainTextToken;

            DB::commit();
            $user = array(
                [
                    'name' => $request->name,
                    'email' => $request->email
                ]
            );
            return response(['status' => 'success', 'message' => 'User created successfully.', 'data' => $user, 'token' => $token], 200);
        } catch (Exception $e) {
            $this->response = errorResponse($e);
        }
    }

    /**
     * Summary of login
     * @param \App\Http\Requests\LoginRequest;
     * @return mixed|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            $email = $request->email;
            $password = $request->password;
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user = Auth::user();
                $token = $user->createToken($user->name)->plainTextToken;
                return response(['status' => 'success', 'token' => $token], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User info are not correct. Please try valid info.'
                ], 401);
            }
        } catch (Exception $e) {
            $this->response = errorResponse($e);
        }
    }

    /**
     * Summary of logout
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $user->currentAccessToken()->delete();
                return response()->json(['status' => 'success', 'message' => 'Successfully logged out']);
            }
            return response()->json(['status' => 'Failed', 'message' => 'User Not Found.']);
        } catch (Exception $e) {
            $this->response = errorResponse($e);
        }
    }

    /**
     * Summary of userDetails
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function user()
    {
        try {
            $user = Auth::user();
            if ($user) {
                return response()->json(['status' => 'Success', 'data' => $user, 'message' => 'User Found'], 200);
            }
            return response()->json(['status' => 'failed', 'message' => 'Not Found'], 401);

        } catch (Exception $e) {
            $this->response = errorResponse($e);
        }

    }

}
