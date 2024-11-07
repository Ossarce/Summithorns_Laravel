<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLikeSpot(string $id, Request $request) {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error' => 'User not logged in'], 403);
        }

        $action = $request->input('action');

        if($action === 'like') {
            $favorite = Favorite::where('user_id', $userId)->where('spot_id', $id)->first();

            if(!$favorite) {
                Favorite::create([
                    'user_id' => $userId,
                    'spot_id' => $id
                ]);
                return response()->json(['status' => 'liked']);
            }
        }

        if($action === 'unlike') {
            $favorite = Favorite::where('user_id', $userId)->where('spot_id', $id)->first();

            if($favorite) {
                $favorite->delete();
                return response()->json(['status' => 'unliked']);
            }
        }
        return response()->json(['error' => 'Invalid action'], 400);
    }
}
