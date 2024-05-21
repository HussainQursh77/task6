<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{



    public function addcomment(Request $request)
    {

        $valdata = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'comment' => 'string'
        ]);

        $comment = Comment::create($valdata);
        return response()->json($comment, 201);
    }




    public function deletecomment($id)
    {

        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json('comment deleted', 204);
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
