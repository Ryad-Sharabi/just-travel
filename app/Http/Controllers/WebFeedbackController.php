<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class WebFeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'item_type' => 'nullable|string',
            'item_name' => 'nullable|string'
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->first_name,
            'email' => Auth::user()->email,
            'message' => $request->message,
            'rating' => $request->rating,
            'item_type' => $request->item_type ?? 'general',
            'item_name' => $request->item_name
        ]);

        return back()->with('success', 'Feedback submitted successfully!');
    }
}
