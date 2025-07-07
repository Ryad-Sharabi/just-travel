<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
   public function store(Request $request)
{
    $user = $request->user();

    $request->validate([
        'message' => 'required|string',
        'item_type' => 'nullable|string',
        'item_name' => 'nullable|string',
        'rating' => 'nullable|numeric',
    ]);

    $feedback = Feedback::create([
        'user_id' => $user->id,
        'name' => $request->name,     
        'email' => $request->email, 
        'message' => $request->message,
        'item_type' => $request->item_type,
        'item_name' => $request->item_name,
        'rating' => $request->rating ?? 0,
    ]);

    return response()->json(['message' => 'Feedback submitted', 'data' => $feedback], 201);
}

}
