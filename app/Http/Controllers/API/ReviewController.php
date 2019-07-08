<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page;
        $current_page = $request->current_page;
        $reviews = Review::with(['user', 'mechanic'])->paginate($per_page, ['*'], 'page', $current_page);
        return response()->json($reviews, 200);
    }

    public function show($id)
    {
        return Review::with(['user', 'mechanic'])->find($id);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(['message' => 'Deletion is successful'], 200);
    }
}
