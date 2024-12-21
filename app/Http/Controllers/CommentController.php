<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

        if($comment) {
            notyf('Tu comentario ha sido publicado.');
        }

        return redirect()->route('public.spot', $spotId);
    }

    public function storeReplyComment(Request $request, $commentId) {
        $request->validate([
            'comment.content' => 'required|string|max:150',
        ]);

        $parentComment = Comment::findOrFail($commentId);

        $reply = $parentComment->replies()->create([
            'user_id' => Auth::id(),
            'comment' => $request->input('comment.content'),
            'commentable_id' => $parentComment->commentable_id,
            'commentable_type' => $parentComment->commentable_type,
        ]);

        if($reply) {
            notyf('Tu respuesta ha sido publicada.');
        }

        return redirect()->back();
    }

    // public function updateComment(Request $request, $commentId) {
    //     $request->validate([
    //         'comment.content' => 'required|string|max:150'
    //     ]);


    // }

    public function deleteComment($commentId) {
        $comment = Comment::findOrFail($commentId);

        if($comment->user_id !== Auth::id()) {
            notyf()->ripple(false)->error('No puedes eliminar comentarios de otros usuarios');
            abort(403, 'Este no es tú comentario.');
        }

        $comment->delete();

        notyf('Comentario eliminado!');

        if(request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Comentario eliminado correctamente'
            ]);
        }

        return redirect()->back();
    }
}
