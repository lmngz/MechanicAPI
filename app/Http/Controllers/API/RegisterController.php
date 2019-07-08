<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\User;
use App\Mechanic;
use App\Vehicle;

use Validator;
use Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function validateEmail(Request $request)
    {
        $register_as = $request->input('register_as');
        if ($register_as == 'user') {
            $count = User::whereEmail($request->input('email'))->count();
            return response()->json([
                'email_exists' => ($count === 0 ? false : true)
            ], $count === 0 ? 200 : 409);
        } else if ($register_as == 'mechanic') {
            $count = Mechanic::whereEmail($request->input('email'))->count();
            return response()->json([
                'email_exists' => ($count === 0 ? false : true)
            ], $count === 0 ? 200 : 409);
        } else {
            return response()->json([
                'email_exists' => null
        ], 400);
        }

        $register_as = $request->input('register_as');
    }

    public function validatePhone(Request $request)
    {
        $register_as = $request->input('register_as');
        if ($register_as == 'user') {
            $count = User::wherePhone($request->input('phone'))->count();
            return response()->json([
                'phone_exists' => ($count === 0 ? false : true)
            ], $count === 0 ? 200 : 409);
        } else if ($register_as == 'mechanic') {
            $count = Mechanic::wherePhone($request->input('phone'))->count();
            return response()->json([
                'phone_exists' => ($count === 0 ? false : true)
            ], $count === 0 ? 200 : 409);
        } else {
            return response()->json([
                'phone_exists' => null
            ], 400);
        }
    }

    public function store(Request $request)
    {
        $register_as = $request->input('register_as');

        if ($register_as === 'user') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191',
                'email' => 'required|email|unique:users|max:191',
                'phone' => 'required|unique:users|min:11|max:11',
                'password' => 'required|min:6',
                'vehicle_type' => 'required|exists:vehicles,type',
                'vehicle' => 'required|max:191',
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->vehicle_id = Vehicle::whereType($request->vehicle_type)->first()->id;
            $user->vehicle = $request->vehicle;
            $user->save();

            return response()->json(['user_created' => true], 201);
        } else if ($register_as === 'mechanic') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191',
                'email' => 'required|email|unique:mechanics|max:191',
                'phone' => 'required|unique:mechanics|min:11|max:11',
                'password' => 'required|min:6',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric'
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $mechanic = new Mechanic;
            $mechanic->name = $request->name;
            $mechanic->email = $request->email;
            $mechanic->phone = $request->phone;
            $mechanic->password = Hash::make($request->password);
            $mechanic->latitude = $request->latitude;
            $mechanic->longitude = $request->longitude;
            $mechanic->save();

            return response()->json(['mechanic_created' => true], 201);
        } else {
            return response()->json([
                'register_as' => "The register_as field must be 'user' or 'mechanic'"
            ], 400);
        }
    }
}
