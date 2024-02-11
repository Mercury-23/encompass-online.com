<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use App\Models\Info;
use App\Models\ShortBios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Log;

class UserController extends Controller
{
    /* View of users page */
    public function index(Request $request)
    {
//        $users = User::select('*')->with('address')->with('bio')->get();
//        return view('user.index', compact('users'));
    }

    /**
     * THIS FUNCTION HAS BEEN TRUNCATED USE "create" INSTEAD
     * API function for create user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * */
    public function store(Request $request)
    {
        $auth = Auth::user();
        $request->validate([
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required",
            'password' => "required",
            'phone_number' => "required",
        ]);

        if($auth->type!=='admin'){
            return response()->json([
                'status_code' => 401,
                'type' => 'error',
                'message' => 'You are not authorized to perform this action.',
            ], 401);
        }


        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'type' => $request->type ?? 'student',
            'phone_number' => $request->phone_number,
            'password' => md5($request->password),
        ]);

        if (!$user) {
            return response()->json([
                'status_code' => 501,
                'type' => 'error',
                'message' => "Sorry! Operation couldn't perform, try again!",
            ], 501);
        }

        if ($request->address) {
            $address = Addresses::create([
                'user_id' => $user->id,
                'address' => $request->address,
            ]);
        }
        if ($request->bio) {
            $bio = ShortBios::create([
                'user_id' => $user->id,
                'short_bio' => $request->bio
            ]);
        }

        return response()->json([
            'status_code' => 201,
            'type' => 'success',
            'message' => 'Great! Record added successfully.',
        ], 201);
    }



    public function create(Request $request)
    {


        $request->validate([
            "first_name" => 'required',
            "last_name" => 'required',
            "email" => 'required|unique:users,email',
            "password" => 'required',
//            "type" => 'required',
//            "address_1" => 'required',
//            "city" => 'required',
//            "state" => 'required',
//            "postal_code" => 'required',
//            "country" => 'required',
        ]);
        DB::beginTransaction();
        $n_user = new User();
        try {
            $n_user->first_name = $request->first_name;
            $n_user->last_name = $request->last_name;
            $n_user->email = $request->email;
            $n_user->type = $request->type;
            $n_user->password = Hash::make($request->password);
            $n_user->information =
            $n_user->save();
            $info = new Info();
            $info->user_id= $n_user->id;
            $info->information =  [
                "tags" => $request->tags,
                "gender" => $request->gender ? $request->gender : 'student',
                "type" => $request->type,
                'address' => [
                    "address_1" => $request->address_1,
                    "address_2" => $request->address_2,
                    "city" => $request->city,
                    "state" => $request->state,
                    "postal_code" => $request->postal_code,
                    "country" => $request->country,
                ],
                "grade" => $request->grade,
                "customer_number" => $request->customer_number,
                "inActive" => $request->inActive,
                "enrollment" => $request->enrollment,
                "home_phone" => $request->home_phone,
                "cell_phone" => $request->cell_phone,
                "source" => $request->source,
                "school_name" => $request->school_name,
                "special_need" => $request->special_need,
                "background" => $request->background,
                "allergies" => $request->allergies,
                "notes" => $request->notes,
            ];
            $info->save();
            $addresses = new Addresses();
            $addresses->user_id = $n_user->id;
                $addresses->address = [
                    "address_1" => $request->address_1,
                    "address_2" => $request->address_2,
                    "city" => $request->city,
                    "state" => $request->state,
                    "postal_code" => $request->postal_code,
                    "country" => $request->country,
                ];
                $addresses->save();
            DB::commit();
            return  response()->json([
                'message'=>'The new user has been created successfully'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return  response()->json([
                'message'=>'error  ',
                'dev_message'=>$exception->getMessage()
            ],500);
        }

    }

    public function get_users_by(Request $request)
    {
        return User::where($request->subject, $request->value)->get();
    }


    public function update(Request $request)
    {

        $auth = Auth::user();
        Log::info($request->all());

//        if($auth->type!=='admin'){
//            return response()->json([
//                'status_code' => 401,
//                'type' => 'error',
//                'message' => 'You are not authorized to perform this action.',
//            ], 401);
//        }


        // todo - Youcef, save the image...Update, etc...

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'first_name' => "required",
            'last_name' => "required",
            'type' => "required",
            'email' => "required",
            'phone_number' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'type' => 'error',
                'message' => $validator->messages()->toArray(),
            ], 400);
        }

        // todo - this needs to only by allowed by admin
        //  - update the user info

        $user = User::where('id', $request->id)->first();
        if (!$user) {
            return response()->json([
                'status_code' => 404,
                'type' => 'error',
                'message' => 'User not found or maybe deleted!'
            ], 404);
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        $user->name = $request->first_name . " " . $request->last_name;
        $user->type = $request->type;

        /* Update passsword if it has been changed */
        if ($request->password) {
            $user->password = md5($request->password);
        }

        if ($request->phone_number) {
            $user->phone_number = $request->phone_number;
        }

        /* Email already exist check */
        $emailExist = User::where('email', $request->email)->whereNot('id', $user->id)->first();

        if ($emailExist) {
            return response()->json([
                'status_code' => 400,
                'type' => 'error',
                'message' => 'This email already exist!'
            ], 400);
        }

        $user->save();


        return response()->json([
            'status_code' => 200,
            'type' => 'success',
            'message' => 'Record updated successfully',
            'data' => $user,
        ], 200);
    }

    /*
     * Delete User
     * */
    public function destroy($id)
    {

        $auth = Auth::user();

        if ($auth->type !== 'admin') {
            return response()->json([
                'status_code' => 401,
                'type' => 'error',
                'message' => 'You are not authorized to perform this action.',
            ], 401);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status_code' => 404,
                'type' => 'error',
                'message' => "Sorry! Record not found.",
            ], 404);
        }

        $user->delete();
        return response()->json([
            'status_code' => 200,
            'type' => 'success',
            'message' => 'Great! Record deleted successfully.',
        ], 200);
    }

    /* API function for get all users */

}

