<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\User;
use App\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return User::paginate($request->per_page, ['*'], 'page', $request->current_page);
    }

    public function show(Request $request)
    {
        return $request->user();
    }

    public function update(Request $request)
    {
        $user = $request->user();
        if ($request->current_password !== null && Hash::check($request->current_password, $user->password)) {
            if ($request->name !== null) $user->name = $request->name;
            if ($request->phone !== null) $user->phone = $request->phone;
            if ($request->vehicle_type !== null) $user->vehicle_id = Vehicle::whereType($request->vehicle_type)->first()->id;
            if ($request->vehicle !== null) $user->vehicle = $request->vehicle;
            if ($request->new_password !== null) $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(['message' => 'Update is successful'], 200);
        } else {
            return response()->json(['message' => 'Wrong password'], 401);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Deletion is successful'], 200);
    }
}
