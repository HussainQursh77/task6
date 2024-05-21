<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valdata = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
            'tag_id' => 'required',
        ]);

        $post = Post::create($valdata);
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with('comments.user:id,name')->findOrFail($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            return response()->json(['message' => 'unauthorized access'], 403);

        }
        $valdata = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'tag_id' => 'required',
        ]);

        $post->update($valdata);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (auth()->id() !== $post->user_id) {
            return response()->json(['message' => 'unauthorized acces'], 403);

        }
        $post->delete();
        return response()->json('post deleted', 204);
    }
}
