<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Mechanic;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function index(Request $request)
    {
        return Mechanic::paginate($request->per_page, ['*'], 'page', $request->current_page);
    }

    public function show(Request $request)
    {
        return DB::table('mechanics')
            ->select('*')
            ->addSelect(DB::raw("(SELECT AVG(star) FROM reviews WHERE reviews.reviewer = 'user' AND reviews.mechanic_id = mechanics.id) AS rating"))
            ->where('id', $request->user()->id)
            ->get();
    }

    public function update(Request $request)
    {
        $mechanic = $request->user();
        if ($request->current_password !== null && Hash::check($request->current_password, $mechanic->password)) {
            if ($request->name !== null) $mechanic->name = $request->name;
            if ($request->phone !== null) $mechanic->phone = $request->phone;
            if ($request->latitude !== null) $mechanic->latitude = $request->latitude;
            if ($request->longitude !== null) $mechanic->vehicle = $request->longitude;
            if ($request->new_password !== null) $mechanic->password = Hash::make($request->new_password);
            $mechanic->save();
            return response()->json(['message' => 'Update is successful'], 200);
        } else {
            return response()->json(['message' => 'Wrong password'], 401);
        }
    }

    public function destroy(Mechanic $mechanic)
    {
        $mechanic->delete();
        return response()->json(['message' => 'Deletion is successful'], 200);
    }
}
