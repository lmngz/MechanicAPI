<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
		$nearby_mechanics = DB::table('mechanics')
			->selectRaw('id, name, email, phone, latitude, longitude, 111.045 * DEGREES(ACOS(COS(RADIANS(?)) * COS(RADIANS(latitude)) * COS(RADIANS(?) - RADIANS(longitude)) + SIN(RADIANS(?)) * SIN(RADIANS(latitude)))) AS distance_in_km', [$request->latitude, $request->longitude, $request->latitude])
			->addSelect(DB::raw("(SELECT AVG(star) FROM reviews WHERE reviewer = 'user' AND mechanic_id = mechanics.id) AS rating"))
			->orderBy('rating', 'desc')
			->orderBy('distance_in_km', 'asc')
			->get()
			->where('distance_in_km', '<=', $request->radius)
			->take(10);
        return response()->json($nearby_mechanics, 200);
    }
}
