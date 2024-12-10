<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeSpotComment(Request $request, $spotId) {
        $request->validate([
            'comment.content' => 'required|string|max:150'
        ]);

        $spot = Spot::findOrFail($spotId);

        $comment = $spot->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->input('comment.content'),
        ]);

        return redirect()->route('public.spot', $spotId);
    }
}
