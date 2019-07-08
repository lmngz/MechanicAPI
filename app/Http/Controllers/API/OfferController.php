<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Offer;
use App\Review;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Request $request)
    {
        $offer = new Offer;
        $offer->user_id = $request->user_id;
        $offer->mechanic_id = $request->mechanic_id;
        $offer->problems = $request->problems;
        $offer->save();
        
        return Offer::with(['user', 'mechanic'])->where('id', $offer->id)->get();
    }

    public function status(Request $request)
    {
        return Offer::with(['user', 'mechanic'])->where('id', $request->offer_id)->get();
    }

    public function cancelRequest(Request $request)
    {
        DB::table('offers')
            ->where('id', $request->offer_id)
            ->update(['cancelled' => true]);
        return response()->json(['message' => 'Request cancelled'], 200);
    }

    public function acceptRequest(Request $request)
    {
        DB::table('offers')
            ->where('id', $request->offer_id)
            ->update(['accepted' => true]);
        return response()->json(['message' => 'Request accepted'], 200);
    }

    public function finishRequest(Request $request)
    {
        DB::table('offers')
            ->where('id', $request->offer_id)
            ->update(['finished' => true]);
        return response()->json(['message' => 'Request finished'], 200);
    }

    public function mechanicStatus(Request $request) {
        return Offer::with(['user', 'mechanic'])
            ->where('mechanic_id', $request->mechanic_id)
            ->where('cancelled', false)
            ->where('finished', false)
            ->latest()
            ->get();
    }

    public function review(Request $request)
    {
        $review = new Review;
        $review->user_id = $request->user_id;
        $review->mechanic_id = $request->mechanic_id;
        $review->star = $request->star;
        $review->reviewer = 'user';
        $review->save();
        return response()->json(['message' => 'Review successful'], 200);
    }
}
